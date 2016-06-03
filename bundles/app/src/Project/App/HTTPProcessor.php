<?php

namespace Project\App;

class HTTPProcessor extends \PHPixie\DefaultBundle\Processor\HTTP\Builder
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * Constructor
     * @param Builder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build 'auth' processor
     * @return HTTPProcessors\Greet
     */
    protected function buildAuthProcessor()
    {
        return new HTTPProcessors\Auth(
            $this->builder->frameworkBuilder()->http(),
            $this->builder->components()
        );
    }
}
