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
}
