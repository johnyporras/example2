<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class ValidationLoginTel extends Validation
{
    public function initialize()
    {

        $this->add(
            "usuario",
            new PresenceOf(
                [
                    'message' => 'No ha especificado un nombre de usuario',
                ]
            )
        );

        $this->add(
            "usuario",
            new StringLength(
                [
                    'max' => 253,
                    'min' => 3,
                    'messageMaximum' => 'Solo estan permitidos un maximo de :max caracteres en este campo',
                    'messageMinimum' => 'Debe haber un minimo de :min caracteres en este campo'
                ]
            )
        );

        $this->add(
            "clave",
            new PresenceOf(
                [
                    'message' => 'No ha especificado una clave',
                ]
            )
        );

    }

}