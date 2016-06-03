<?php

namespace Project\App;

/**
 * Here you can define wrappers for the ORM to use.
 */
class ORMWrappers extends \PHPixie\ORM\Wrappers\Implementation
{
    /**
     * Array of model names that have custom Entity wrappers
     * @var array
     */
    protected $databaseRepositories = array(
        'user'
    );

    protected function userRepository($repository)
    {
        return new ORM\User\UserRepository($repository);
    }
}
