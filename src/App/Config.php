<?php

$container->set('db_settings', function () {
    return (object) [
        "DB_HOST" => "localhost",
        "DB_NAME" => "pruebas_gym",
        "DB_USER" => "root",
        "DB_PASS" => "",
        "DB_CHAR" => "utf8"
    ];
});
