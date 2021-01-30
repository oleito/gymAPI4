<?php

namespace App\Models;

use Psr\Container\ContainerInterface;

class BaseModel
{
    protected $pdo;
    protected $logger;

    public function __construct()
    {
    }
}
