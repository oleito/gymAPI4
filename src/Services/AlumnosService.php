<?php

namespace App\Services;

use App\Models\AlumnosModel;

class AlumnosService
{
    protected $alumnosModel;

    public function __construct(AlumnosModel $model)
    {
        $this->alumnosModel = $model;
    }

    public function getAll()
    {
        return $this->alumnosModel->getAllAlumnos();
    }

    public function post($body)
    {
        return $this->alumnosModel->postAlumno($body);
    }

    public function getById($id)
    {
        return $this->alumnosModel->getAlumnoById($id);
    }

    public function deleteById($id)
    {
        return $this->alumnosModel->deleteAlumno($id);
    }

    public function put($body, $id)
    {
        return $this->alumnosModel->putAlumno($body, $id);
    }
}
