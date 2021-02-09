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

    public function getById(Request $request, Response $response, $args)
    {
        $validator = new Validator($args, [
            ['id', ['required', 'type' => 'int']]
        ]);

        if ($validator->getStatus() === true) return $this->responseHandler($response, $this->container->get('alumnos_service')->getById($args['id']));
        return $this->responseHandler($response, [], 400);
    }

    public function post(Request $request, Response $response, $args)
    {
        $rq = (array)json_decode($request->getBody());
        $body = (array) $rq['body'];

        $validator = new Validator($body, [
            ['first_name', ['required', 'minlength' => '5', 'maxlength' => '7']],
            ['last_name', ['required']]
        ]);

        if ($validator->getStatus() === true) return $this->responseHandler($response, $this->container->get('alumnos_service')->post($body));

        return $this->responseHandler($response, $validator->getErrors(), 400);
    }

    public function put(Request $request, Response $response, $args)
    {
        $validator = new Validator($args, [
            ['id', ['required', 'type' => 'int']]
        ]);

        if ($validator->getStatus() === true) {
            $curr = $this->container->get('alumnos_service')->getById($args['id']);
            if ($curr) {
                $rq = (array)json_decode($request->getBody());
                $body = (array) $rq['body'];

                $vali2 = new Validator($body, [
                    ['first_name', ['required', 'minlength' => '5', 'maxlength' => '7']],
                    ['last_name', ['required']]
                ]);

                if ($vali2->getStatus() === true) return $this->responseHandler($response, $this->container->get('alumnos_service')->put($body, $args['id']));

                return $this->responseHandler($response, [], 400);
            }
            return $this->responseHandler($response, [], 404);
        }
        return $this->responseHandler($response, [], 400);
    }

    public function delete(Request $request, Response $response, $args)
    {
        $validator = new Validator($args, [
            ['id', ['required', 'type' => 'int']]
        ]);

        if ($validator->getStatus() === true) {
            $curr = $this->container->get('alumnos_service')->getById($args['id']);
            if ($curr) {
                return $this->responseHandler($response, $this->container->get('alumnos_service')->deleteById($args['id']));
            }
            return $this->responseHandler($response, [], 404);
        }
        return $this->responseHandler($response, [], 400);
    }
};
