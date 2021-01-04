<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function getAll(Request $request, Response $response, $args)
    {
        $db = $this->container->get('db');

        echo '<pre>';
        var_dump($db);
        echo '</pre>';

        $this->logger->warning('Something interesting happened here');

        $response->getBody()->write("Hello world! OK Controller");
        return $response;
    }
};
