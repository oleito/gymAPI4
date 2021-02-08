<?php

namespace App\Models;

use Exception;

class AlumnosModel extends BaseModel
{

    public function getAllAlumnos()
    {
        $sql = "SELECT * FROM `alumnos`";
        return $this->fetchAll($sql);
    }

    public function getAlumnoById($id)
    {
        // ! Al ingresar un string devuelve FALSE
        $sql = "SELECT * FROM `alumnos` WHERE alumnos.alumno_id = :id ;";
        return $this->fetch($sql, [':id' => $id]);
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

        $result = $this->tryQuery($sql, $newAlumno);

        return null == $result ? null : $this->getAllAlumnos();
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

        $result = $this->tryQuery($sql, $updateAlumno);
        
        return null == $result ? null : $this->getAllAlumnos();
    }

    public function deleteAlumno($id)
    {
        $sql = "DELETE FROM `alumnos` WHERE `alumnos`.`alumno_id` = :id ;";

        $result = $this->tryQuery($sql, [':id' => $id]);

        return null == $result ? null : $this->getAllAlumnos();
    }
}
