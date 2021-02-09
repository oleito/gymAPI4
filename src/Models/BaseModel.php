<?php

namespace App\Models;

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

    /**
     * Obtiene el listado completo de la consulta SQL
     */
    protected function fetchAll($sql, $array = [])
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($array);
            return $sth->fetchAll();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);
            return null;
        }
    }
    
    /**
     * Obtiene el ultimo registro de la consulta SQL
     */
    protected function fetch($sql, $array = [])
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($array);
            return $sth->fetch();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);
            return null;
        }
    }

    /**
     * Realiza una consulta SQL generica
     */
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
