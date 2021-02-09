<?php

namespace App\Services;

class ValidatorService
{
    private $body;
    private $validators;

    private $isValid = true;

    private $errors = [];


    public function __construct($b, array $validators = [])
    {
        $this->body = $b;
        $this->validators = $validators;
        $this->validate();
    }

    function validate()
    {

        foreach ($this->validators as $fill) {

            // Clave del array
            $KeyName = $fill[0];
            // Listado de validadores
            $Validators = $fill[1];


            /**
             * Campo es requerido
             */
            if (in_array('required', $Validators)) {
                if (!array_key_exists($KeyName, $this->body)) {
                    $this->isValid = false;
                    array_push($this->errors, 'El campo ' . $KeyName . ' es requerido.');
                }
            }

            /** 
             * Campo tiene longitud minima
             */
            if (array_key_exists('minlength', $Validators)) {
                if (strlen($this->body[$KeyName]) < $Validators['minlength']) {
                    $this->isValid = false;
                    array_push($this->errors, 'El campo ' . $KeyName . ' valor insuficiente.');
                }
            }

            /** 
             * Campo tiene longitud maxima
             */
            if (array_key_exists('maxlength', $Validators)) {
                if (strlen($this->body[$KeyName]) > $Validators['maxlength']) {
                    $this->isValid = false;;
                    array_push($this->errors, 'El campo ' . $KeyName . ' excede su valor.');
                }
            }

            /**
             * Campo es de un tipo especifico
             */
            if (array_key_exists('type', $Validators)) {
                switch ($Validators['type']) {

                        // Campo tipo entero
                    case 'int':
                        $this->body[$KeyName] = filter_var($this->body[$KeyName], FILTER_VALIDATE_INT);
                        if (!is_numeric($this->body[$KeyName])) {
                            array_push($this->errors, 'El campo ' . $KeyName . ' debe ser tipo int.');
                            $this->isValid = false;;
                        }
                        break;

                        // Campo tipo email
                    case 'email':
                        $this->body[$KeyName] = filter_var($this->body[$KeyName], FILTER_VALIDATE_EMAIL);
                        if ($this->body[$KeyName]) {
                            array_push($this->errors, 'El campo ' . $KeyName . ' debe ser tipo email.');
                            $this->isValid = false;;
                        }
                        break;
                }
            }

            if (array_key_exists('inlist', $Validators)) {
                if (!in_array($this->body[$KeyName], $Validators['inlist'])) return true;
            }
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
