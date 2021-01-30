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
        return $this->responseHandler($response, $p);
    }

    public function getById(Request $request, Response $response, $args)
    {
        // ! Revisar que el valor sea un numero
        $id = $args['id'];
        $p = $this->container->get('alumnos_service')->getById($id);

        return $this->responseHandler($response, $p);
    }

    public function post(Request $request, Response $response, $args)
    {
        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];

        $p = $this->container->get('alumnos_service')->post($body);

        return $this->responseHandler($response, $p);
    }

    public function put(Request $request, Response $response, $args)
    {
        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];

        $id = $args['id'];

        $p = $this->container->get('alumnos_service')->put($body, $id);

        return $this->responseHandler($response, $p);
    }

    public function delete(Request $request, Response $response, $args)
    {
        // ! Revisar que el valor sea un numero
        // ! Revisar que el registro no exista, sino deolver codigo
        // $this->container->set('statusCode', 500);
        $id = $args['id'];
        $p = $this->container->get('alumnos_service')->deleteById($id);

        return $this->responseHandler($response, $p);
    }
};
