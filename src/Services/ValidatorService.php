<?php

namespace App\Services;

class ValidatorService
{
    private $body;
    private $params;
    private $allowKeys = array();
    private $isValid = true;
    public function __construct($b, array $validators)
    {
        $this->body = $b;
        $this->params = $validators;
        $this->validate();
        // var_dump($this->allowKeys);
    }

    function validate()
    {
        foreach ($this->params as $fill) {
            $currentKeyName = $fill[0];
            $currentValidators = $fill[1];

            if (in_array('required', $currentValidators)) {
                if (!array_key_exists($currentKeyName, $this->body)) return false;
            }

            if (array_key_exists('minlength', $currentValidators)) {
                if (strlen($currentKeyName) < $currentValidators['minlength']) return false;
            }

            if (array_key_exists('maxlength', $currentValidators)) {
                if (strlen($currentKeyName) > $currentValidators['maxlength']) return false;
            }

            if (array_key_exists('type', $currentValidators)) {
                switch ($currentValidators['type']) {
                    case 'int':
                        # code...
                        break;
                    default:
                        # code...
                        break;
                }
            }
            if (array_key_exists('inlist', $currentValidators)) {
                if (!in_array($currentKeyName, $currentValidators['inlist'])) return true;
            }

            array_push($this->allowKeys, $currentKeyName);
        }
    }
}
