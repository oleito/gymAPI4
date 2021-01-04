<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function getAll(Request $request, Response $response, $args)
    {
        $db_settings = $this->container->get('db_settings');

        echo '<pre>';
        var_dump($db_settings);
        echo '</pre>';

        $this->logger->warning('Something interesting happened here');

        $response->getBody()->write("Hello world! OK Controller");
        return $response;
    }
};
