<?php

use Psr\Container\ContainerInterface;

$container->set('logger', function () {
    $logger = new \Monolog\Logger('gymAPP');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    $logger->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
    return $logger;
});

$container->set('db', function (ContainerInterface $c) {

    $config = $c->get('db_settings');

    $DB_HOST = $config->DB_HOST;
    $DB_NAME = $config->DB_NAME;
    $DB_PASSWORD = $config->DB_PASS;
    $DB_CHARSET = $config->DB_CHAR;
    $DB_USER = $config->DB_USER;

    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $dsn = "mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME . ";charset=" . $DB_CHARSET;

    return new PDO($dsn, $DB_USER, $DB_PASSWORD, $opt);
});


//Variables de control
$container->set('statusCode', function ($statusCode) {
    $statusCode=200;
    
    return $statusCode;
});
