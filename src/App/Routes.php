<?php

use Slim\Routing\RouteCollectorProxy;

$app->group("/public", function (RouteCollectorProxy $group) {
    $group->get("/", 'App\Controllers\TestController:getAll');
});
