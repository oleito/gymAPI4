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
        $response
            ->getBody()
            ->write(json_encode($p));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    }

    public function getById(Request $request, Response $response, $args)
    {
        // ! Revisar que el valor sea un numero
        $id=$args['id'];
        $p = $this->container->get('alumnos_service')->getById($id);

        $response
            ->getBody()
            ->write(json_encode($p));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    }

    public function post(Request $request, Response $response, $args)
    {
        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];

        $p = $this->container->get('alumnos_service')->post($body);

        $response
            ->getBody()
            ->write(json_encode($p));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    }

    public function put(Request $request, Response $response, $args)
    {
        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];

        $id=$args['id'];

        $p = $this->container->get('alumnos_service')->put($body, $id);

        $response
            ->getBody()
            ->write(json_encode($p));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    }

    public function delete(Request $request, Response $response, $args)
    {
        // ! Revisar que el valor sea un numero
        $id=$args['id'];
        $p = $this->container->get('alumnos_service')->deleteById($id);

        $response
            ->getBody()
            ->write(json_encode($p));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    }
    
};
