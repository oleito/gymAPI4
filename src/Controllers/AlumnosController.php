<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\BaseController;
use App\Services\ValidatorService as Validator;

class AlumnosController extends BaseController
{
    public function getAll(Request $request, Response $response, $args)
    {
        $p = $this->container->get('alumnos_service')->getAll();
        return $this->responseHandler($response, $p);
    }

    //
    // public static function required() {
    //     if (!$valorAEvaluar) {
    //         this-errors[$nombreCampoPost] = ['message' => 'El campo ' . $nombreTextoCampo . ' no puede estar vacío']
    //     }
    // }

    public function getById(Request $request, Response $response, $args)
    {
        $id = $args['id'];

        // ! Revisar que el valor sea un numero
        $p = $this->container->get('alumnos_service')->getById($id);

        return $this->responseHandler($response, $p);
    }



    public function post(Request $request, Response $response, $args)
    {
        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];
        // ! revisar que el objeto este bien formado

        $v = new Validator($body, [
            ['first_name', [
                'required',
                'minlength' => '5',
                'maxlength' => '10',
                'type' => 'int'
            ]],
            ['last_name', ['required']]
        ]);

        $p = $this->container->get('alumnos_service')->post($body);
        // $p = $v;

        return $this->responseHandler($response, $p);
    }

    public function put(Request $request, Response $response, $args)
    {
        // ! Revisar que el recurso exista
        $id = $args['id'];

        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];
        // ! revisar que el objeto este bien formado

        $p = $this->container->get('alumnos_service')->put($body, $id);

        return $this->responseHandler($response, $p);
    }

    public function delete(Request $request, Response $response, $args)
    {
        // ! Revisar que el valor sea un numero
        $id = $args['id'];
        // $this->container->set('statusCode', 500);

        // ! Revisar que el registro no exista, sino deolver codigo
        $p = $this->container->get('alumnos_service')->deleteById($id);

        return $this->responseHandler($response, $p);
    }
};
