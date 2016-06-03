<?php

namespace Project\App\HTTPProcessors;

use PHPixie\HTTP\Request;
use PHPixie\Template;

class Auth extends \PHPixie\DefaultBundle\Processor\HTTP\Actions
{
    protected $frameworkHttp;
    protected $components;

    public function __construct($frameworkHttp, $components)
    {
        $this->frameworkHttp = $frameworkHttp;
        $this->components = $components;
    }

    public function defaultAction($request)
    {
        $user = $this->authDomain()->user();

        if($user === null) {
            return $this->routeRedirect('app.login');
        }

        $template = $this->components->template();
        return $template->get('app:frontpage', array('user' => $user));
    }

    public function loginAction($request)
    {
        $socialProvider = $request->attributes()->get('socialProvider');
        if($socialProvider) {
            $callbackUrl = $this->buildCallbackUrl($socialProvider);
            $url = $this->authSocial()->loginUrl($socialProvider, $callbackUrl);
            return $this->redirect($url);
        }

        $template = $this->components->template();
        return $template->get('app:login');
    }

    public function callbackAction($request)
    {
        $socialProvider = $request->attributes()->getRequired('socialProvider');
        $callbackUrl = $this->buildCallbackUrl($socialProvider);
        $query = $request->query()->get();

        $socialUser = $this->authSocial()->handleCallback($socialProvider, $callbackUrl, $query);

        // If the user declined authorization
        if($socialUser === null) {
            return $this->routeRedirect('app.login');
        }

        $user = $this->authDomain()->user();
        $isNew = $user === null;

        if($isNew) {
            $user = $this->registerNewUser($socialUser);
            $this->authSocial()->setUser($user);
        }

        $template = $this->components->template();
        return $template->get('app:success', array(
            'user'       => $user,
            'socialUser' => $socialUser,
            'isNew'      => $isNew
        ));
    }

    protected function registerNewUser($socialUser)
    {
        $userRepository = $this->components->orm()->repository('user');
        $user = $userRepository->create();
        $providerIdField = $userRepository->socialIdField($socialUser->providerName());

        $user->$providerIdField = $socialUser->id();
        $user->save();
        return $user;
    }

    public function logoutAction()
    {
        $domain = $this->components->auth()->domain();
        $domain->forgetUser();

        $http = $this->components->http();
        return $this->routeRedirect('app.login');
    }

    protected function buildCallbackUrl($socialProvider)
    {
        return (string) $this->frameworkHttp->generateUri('app.loginCallback', array(
            'socialProvider' => $socialProvider
        ));
    }

    protected function routeRedirect($route, $params = array())
    {
        $url = $this->frameworkHttp->generatePath($route, $params);
        return $this->redirect($url);
    }

    protected function authDomain()
    {
        return $this->components->auth()->domain();
    }

    protected function authSocial()
    {
        return $this->authDomain()->provider('social');
    }

    protected function redirect($url)
    {
        $http = $this->components->http();
        return $http->responses()->redirect($url);
    }
}
