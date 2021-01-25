<?php

namespace App\Models;

use Exception;

class AlumnosModel
{

    protected $pdo;
    protected $logger;

    public function __construct($c)
    {
        $this->pdo = $c->get('db');
        $this->logger = $c->get('logger');;
    }

    public function getAllAlumnos()
    {
        $sql = "SELECT * FROM `alumnos`";
        try {
            $query = $this->pdo->query($sql);
            $result = $query->fetchAll();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);

            $result = null;
        }
        return $result;
    }


    public function getAlumnoById($id)
    {
        $idAlumno[':id'] = $id;
        $sql = "SELECT * FROM `alumnos` WHERE alumno_id = :id";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($idAlumno);
            $result = $this->getAllAlumnos();
            // marca
            $query = $this->pdo->query($sql);
            $result = $query->fetchAll();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);

            $result = null;
        }
        return $result;
    }


    public function postAlumno($a)
    {
        // {
        //     "body": {
        //         "first_name": "Leandro",
        //         "last_name": "Nicolas",
        //         "last_update": "2021-01-04 01:13:03"
        //     }
        // }

        $newAlumno[':first_name'] = $a['first_name'];
        $newAlumno[':last_name'] = $a['last_name'];
        $newAlumno[':last_update'] = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `alumnos` 
                (`alumno_id`, `first_name`, `last_name`, `last_update`) 
                VALUES 
                (NULL, :first_name, :last_name, :last_update);";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($newAlumno);
            $result = $this->getAllAlumnos();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);

            $result = null;
        }
        return $result;
    }

    public function putAlumno()
    {
        // ! crear SQL
        $sql = "UPDATE INTO `alumnos` (`alumno_id`, `first_name`, `last_name`, `last_update`) VALUES (NULL, 'Leandro', 'Nicolas', '2021-01-04 01:13:03');";
        try {
            $query = $this->pdo->query($sql);
            $result = $query->fetchAll();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);

            $result = null;
        }
        return $result;
    }

    public function deleteAlumno()
    {
        // ! revisar SQL y metodo
        $algo = 0;
        $sql = "DELETE FROM `alumnos` WHERE idalumno = $algo";
        try {
            $query = $this->pdo->query($sql);
            $result = $query->fetchAll();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);

            $result = null;
        }
        return $result;
    }
}
