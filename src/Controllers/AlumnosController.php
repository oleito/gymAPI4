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
        // Llama al servicio que obtiene todos los recursos
        return $this->responseHandler($response, $this->container->get('alumnos_service')->getAll());
    }

    public function getById(Request $request, Response $response, $args)
    {
        // Revisa que el ID sea valido
        $validator = new Validator($args, [
            ['id', ['required', 'type' => 'int']]
        ]);

        // Llama al servicio que obtiene un recurso especifico
        if ($validator->getStatus() === true) return $this->responseHandler($response, $this->container->get('alumnos_service')->getById($args['id']));
        return $this->responseHandler($response, [], 400);
    }

    public function post(Request $request, Response $response, $args)
    {
        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];

        // Revisa que el array de datos sea valido
        $validator = new Validator($body, [
            ['first_name', ['required', 'minlength' => '5', 'maxlength' => '7']],
            ['last_name', ['required']]
        ]);

        // Llama al servicio para crear un recurso
        if ($validator->getStatus() === true) return $this->responseHandler($response, $this->container->get('alumnos_service')->post($body));

        return $this->responseHandler($response, $validator->getErrors(), 400);
    }

    public function put(Request $request, Response $response, $args)
    {
        // Revisa que el ID sea valido
        $validator = new Validator($args, [
            ['id', ['required', 'type' => 'int']]
        ]);

        if ($validator->getStatus() === true) {

            // Revisa que el recurso exista.
            $curr = $this->container->get('alumnos_service')->getById($args['id']);
            if ($curr) {

                $rq = (array)json_decode($request->getBody());
                $body = (array) $rq['body'];

                // Revisa que los datos que ingresan sean validos
                $vali2 = new Validator($body, [
                    ['first_name', ['required', 'minlength' => '5', 'maxlength' => '7']],
                    ['last_name', ['required']]
                ]);

                // Llama al servicio para actualizar el recurso
                if ($vali2->getStatus() === true) return $this->responseHandler($response, $this->container->get('alumnos_service')->put($body, $args['id']));

                return $this->responseHandler($response, [], 400);
            }
            return $this->responseHandler($response, [], 404);
        }
        return $this->responseHandler($response, [], 400);
    }

    public function delete(Request $request, Response $response, $args)
    {
        // Revisa que el ID sea valido
        $validator = new Validator($args, [
            ['id', ['required', 'type' => 'int']]
        ]);

        if ($validator->getStatus() === true) {

            // Revisa que el recurso exista
            $curr = $this->container->get('alumnos_service')->getById($args['id']);
            if ($curr) {

                // Llama al servicio para eliminar el recurso
                return $this->responseHandler($response, $this->container->get('alumnos_service')->deleteById($args['id']));
            }
            return $this->responseHandler($response, [], 404);
        }
        return $this->responseHandler($response, [], 400);
    }
};
