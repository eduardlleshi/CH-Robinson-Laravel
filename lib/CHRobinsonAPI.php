<?php

namespace CHRobinson;

use CHRobinson\Environment\EnvironmentInterface;

class CHRobinsonAPI
{
    protected $environment;

    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment = $environment;
    }
}
