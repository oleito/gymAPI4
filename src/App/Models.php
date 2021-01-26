<?php

use Psr\Container\ContainerInterface;

use App\Models\AlumnosModel;

$container->set('alumnos_model', function (ContainerInterface $c) {
    return new AlumnosModel($c);
});
