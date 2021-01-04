<?php

$container->set('db_settings', function () {
    return (object) [
        "DB_HOST" => "",
        "DB_NAME" => "",
        "DB_USER" => "",
        "DB_PASS" => "",
        "DB_CHAR" => ""
    ];
});
