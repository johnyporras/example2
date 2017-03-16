<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Email;

class ValidationRegistro extends Validation
{
    public function initialize()
    {

        $this->add(
            "user",
            new PresenceOf(
                [
                    'message' => 'No ha especificado un nombre de Usuario',
                ]
            )
        );

        $this->add(
            "user",
            new StringLength(
                [
                    'max' => 253,
                    'min' => 3,
                    'messageMaximum' => 'Solo estan permitidos un maximo de :max caracteres en el campo Usuario',
                    'messageMinimum' => 'Debe haber un minimo de :min caracteres en el campo Usuario'
                ]
            )

        );

        $this->add(
            "name",
            new PresenceOf(
                [
                    'message' => 'No ha especificado un Nombre',
                ]
            )
        );

        $this->add(
            "name",
            new StringLength(
                [
                    'max' => 253,
                    'min' => 3,
                    'messageMaximum' => 'Solo estan permitidos un maximo de :max caracteres en el campo Nombre',
                    'messageMinimum' => 'Debe haber un minimo de :min caracteres en el campo Nombre'
                ]
            )

        );

        $this->add(
            "email",
            new PresenceOf(
                [
                    'message' => 'No ha especificado un email',
                ]
            )
        );

        $this->add(
            "email",
            new Email(
                [
                    "message" => "Formato de email no valido"
                ]
            )

        );

        $this->add(
            "password",
            new PresenceOf(
                [
                    'message' => 'Debe especificar una contraseña',
                ]
            )
        );

        $this->add(
            "repClave",
            new PresenceOf(
                [
                    'message' => 'Debe repetir la contraseña',
                ]
            )
        );

    }

}