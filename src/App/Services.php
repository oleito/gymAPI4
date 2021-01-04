<?php

use App\Services\AlumnosService;
use Psr\Container\ContainerInterface;

$container->set('alumnos_service', function (ContainerInterface $c) {
    return new AlumnosService($c->get('alumnos_model'));
});
