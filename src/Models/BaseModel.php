<?php

namespace App\Models;

use Psr\Container\ContainerInterface;
use Exception;

class BaseModel
{
    protected $pdo;
    protected $logger;


    public function __construct($c)
    {
        $this->pdo = $c->get('db');
        $this->logger = $c->get('logger');;
    }


    protected function fetchAll($sql, $array = [])
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($array);
            return  $sth->fetchAll();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);
            return  null;
        }
    }

    protected function fetch($sql, $array = [])
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($array);
            return  $sth->fetch();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);
            return  null;
        }
    }

    protected function tryQuery($sql, $a = [])
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($a);
            return true;
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);
            return null;
        }
    }
}
