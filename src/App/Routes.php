<?php

use Psr\Container\ContainerInterface;

use Slim\Routing\RouteCollectorProxy;

$app->group("/public", function (RouteCollectorProxy $group) {
    $group->get("/alumnos", 'App\Controllers\AlumnosController:getAll');
    $group->get("/alumnos/{id}", 'App\Controllers\AlumnosController:getById');
    $group->post("/alumnos", 'App\Controllers\AlumnosController:post');
});
