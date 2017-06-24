<?php

use Phalcon\Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class AcAfiliados extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=20, nullable=false)
     */
    public $cedula;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    public $apellido;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_nacimiento;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    public $sexo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $tipo_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $telefono;

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
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_cuenta;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_estado;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $ciudad;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $embarazada;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $tiempo_gestacion;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("atiempo_dev");
        $this->belongsTo('id_estado', '\AcEstados', 'es_id', ['alias' => 'AcEstados']);
        $this->belongsTo('id_cuenta', '\AcCuenta', 'id', ['alias' => 'AcCuenta']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_afiliados';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcAfiliados[]|AcAfiliados
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcAfiliados
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
