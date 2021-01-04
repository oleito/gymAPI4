<?php

namespace App\Models;

use Exception;

class AlumnosModel
{
    protected $pdo;
    public function __construct($db)
    {
        $this->pdo = $db;
    }

    public function getAllAlumnos()
    {
        $sql = "SELECT * FROM `alumnos`";
        try {
            $query = $this->pdo->query($sql);
            $result = $query->fetchAll();
        } catch (Exception $e) {
            $this->logger->warning('AlumnosModel - ', [$e->getMessage()]);

            $result = null;
        }
        return $result;
    }

    // INSERT INTO `alumnos` (`alumno_id`, `first_name`, `last_name`, `last_update`) VALUES (NULL, 'Leandro', 'Nicolas', '2021-01-04 01:13:03');
}
