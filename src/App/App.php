<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../../vendor/autoload.php';

// Se crea un contenedor y su instancia
$container = new \DI\Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$container = $app->getContainer();

// Imports
require __DIR__ . '/Config.php';
require __DIR__ . '/Dependencies.php';
require __DIR__ . '/Routes.php';
require __DIR__ . '/Models.php';
require __DIR__ . '/Services.php';



// TODO: Setear en False -> detalles de errores
$app->addErrorMiddleware(true, true, true);

$app->run();
