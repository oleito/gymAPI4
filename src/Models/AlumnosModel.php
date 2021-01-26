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
        // ! Al ingresar un string devuelve FALSE
        $sql = "SELECT * FROM `alumnos` WHERE alumnos.alumno_id = :id ;";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id' => $id,
            ));
            $result = $sth->fetch();
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

    public function putAlumno($a, $id)
    {
        // {
        //     "body": {
        //         "first_name": "Felipin",
        //         "last_name": "Miguelin",
        //         "last_update": "2021-01-04 01:13:03"
        //     }
        // }

        $updateAlumno[':first_name'] = $a['first_name'];
        $updateAlumno[':last_name'] = $a['last_name'];
        $updateAlumno[':last_update'] = $a['last_update'];
        $updateAlumno[':id'] = $id;

        $sql = "UPDATE `alumnos` SET `first_name` = :first_name, `last_name` = :last_name, `last_update` = :last_update WHERE `alumnos`.`alumno_id` = :id;";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($updateAlumno);
            $result = $this->getAllAlumnos();;
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);
            $result = null;
        }
        return $result;
    }

    public function deleteAlumno($id)
    {
        $sql = "DELETE FROM `alumnos` WHERE `alumnos`.`alumno_id` = :id ;";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id' => $id,
            ));
            $result = $this->getAllAlumnos();
        } catch (Exception $e) {
            $this->logger->warning(get_class($this), [$e->getMessage()]);
            $result = null;
        }
        return $result;
    }
}
