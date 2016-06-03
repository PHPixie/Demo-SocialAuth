<?php
namespace Project\App\ORM\User;

class UserRepository extends  \PHPixie\AuthORM\Repositories\Repository
                     implements \PHPixie\AuthSocial\Repository
{
    public function getBySocialUser($socialUser)
    {
        $providerName = $socialUser->providerName();
        $field = $this->socialIdField($providerName);
        return $this->query()->where($field, $socialUser->id())->findOne();
    }

    public function socialIdField($providerName)
    {
        return $providerName.'Id';
    }
}
