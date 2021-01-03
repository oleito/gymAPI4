<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

$app->get("/public/", function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world! OK");
    return $response;
});