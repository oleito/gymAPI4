<?php

namespace App\Services;

class ValidatorService
{
    private $body;
    private $params;

    private $isValid = true;

    private $allowKeys = [];
    private $errors = [];

    public function __construct($b, array $validators = [])
    {
        $this->body = $b;
        $this->params = $validators;
        $this->validate();
    }

    function validate()
    {

        foreach ($this->params as $fill) {

            // Clave del array
            $KeyName = $fill[0];
            // Listado de validadores
            $Validators = $fill[1];

            if (in_array('required', $Validators)) {
                if (!array_key_exists($KeyName, $this->body)) {
                    $this->isValid = false;
                    array_push($this->errors, 'El campo ' . $KeyName . ' es requerido.');
                }
            }

            if (array_key_exists('minlength', $Validators)) {
                if (strlen($this->body[$KeyName]) < $Validators['minlength']) {
                    $this->isValid = false;
                    array_push($this->errors, 'El campo ' . $KeyName . ' valor insuficiente.');
                }
            }

            if (array_key_exists('maxlength', $Validators)) {
                if (strlen($this->body[$KeyName]) > $Validators['maxlength']) {
                    $this->isValid = false;;
                    array_push($this->errors, 'El campo ' . $KeyName . ' excede su valor.');
                }
            }

            if (array_key_exists('type', $Validators)) {
                switch ($Validators['type']) {
                    case 'int':
                        $this->body[$KeyName] = filter_var($this->body[$KeyName], FILTER_VALIDATE_INT);
                        if (!is_numeric($this->body[$KeyName])) {
                            array_push($this->errors, 'El campo ' . $KeyName . ' debe ser tipo int.');
                            $this->isValid = false;;
                        }
                        break;
                    case 'email':
                        $this->body[$KeyName] = filter_var($this->body[$KeyName], FILTER_VALIDATE_EMAIL);
                        if ($this->body[$KeyName]) {
                            array_push($this->errors, 'El campo ' . $KeyName . ' debe ser tipo email.');
                            $this->isValid = false;;
                        }
                        break;
                    default:
                        # code...
                        break;
                }
            }
            if (array_key_exists('inlist', $Validators)) {
                if (!in_array($this->body[$KeyName], $Validators['inlist'])) return true;
            }
            array_push($this->allowKeys, $KeyName);
        }

        return $this;
    }
    public function getStatus()
    {
        return $this->isValid;
    }
    public function getErrors()
    {
        return $this->errors;
    }
}
