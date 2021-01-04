<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\BaseController;

class AlumnosController extends BaseController
{
    public function getAll(Request $request, Response $response, $args)
    {
        $p = $this->container->get('alumnos_service')->getAll();
        $response->getBody()->write(json_encode($p));
        return $response;
    }
};
