<?php

return array(
    'type'      => 'group',
    'resolvers' => array(

        'logout' => array(
            'path'     => 'logout',
            'defaults' => array(
                'processor' => 'auth',
                'action'    => 'logout'
            )
        ),

        'login' => array(
            'path'     => 'login',
            'defaults' => array(
                'processor' => 'auth',
                'action'    => 'login'
            )
        ),

        'loginRedirect' => array(
            'path'     => 'login(/<socialProvider>)',
            'defaults' => array(
                'processor' => 'auth',
                'action'    => 'login'
            )
        ),

        'loginCallback' => array(
            'path'     => 'callback/<socialProvider>',
            'defaults' => array(
                'processor' => 'auth',
                'action'    => 'callback'
            )
        ),

        'frontpage' => array(
            'path'     => '',
            'defaults' => array(
                'processor' => 'auth',
                'action'    => 'default'
            )
        ),
    )
);
