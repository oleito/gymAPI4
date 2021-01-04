<?php

use Slim\Routing\RouteCollectorProxy;

$app->group("/public", function (RouteCollectorProxy $group) {
    $group->get("/alumnos", 'App\Controllers\AlumnosController:getAll');
});
