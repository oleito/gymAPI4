<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

class BaseController
{
    protected $container;
    protected $logger;
    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        $this->logger = $c->get('logger');
    }
}
