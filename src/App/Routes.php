<?php

use Slim\Routing\RouteCollectorProxy;

$app->group("/public", function (RouteCollectorProxy $group) {
    $group->get("/alumnos", 'App\Controllers\AlumnosController:getAll');
    $group->post("/alumnos", 'App\Controllers\AlumnosController:post');
    $group->get("/alumnos/{id}", 'App\Controllers\AlumnosController:getById');
    $group->put("/alumnos/{id}", 'App\Controllers\AlumnosController:put');
    $group->delete("/alumnos/{id}", 'App\Controllers\AlumnosController:delete');
});
