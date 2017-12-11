<?php

use Phalcon\Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $user;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $clave;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $department;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $imagen_perfil;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $type;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $active;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $pregunta_1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $respuesta_1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $pregunta_2;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $respuesta_2;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $ultimo_acceso;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $detalles_usuario_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $confirm_token;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $remember_token;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $deleted_at;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
     /*   $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);*/
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("atiempo_prod");
        $this->hasMany('id', 'Funerario', 'creador', ['alias' => 'Funerario']);
        $this->hasMany('id', 'HistorialMedico', 'id_user', ['alias' => 'HistorialMedico']);
        $this->belongsTo('detalles_usuario_id', 'Operador', 'id', ['alias' => 'Operador']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
