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

    function responseHandler($response, $body)
    {

        // $responseCodeList = array(
        //     '' => , 
        // );
        // $this->container->get('statusCode') != $statusCode ? $body=null : 'f';
        $response
            ->getBody()
            ->write(json_encode($body));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    }
}
