<?php

use Phalcon\Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class AcProveedoresExtranet extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $codigo_proveedor;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $cedula;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $nombre;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_especialidad;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $direccion;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $telefono;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $tipo_cuenta;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $numero_cuenta;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $estado_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $ciudad;

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
        $this->setSchema("atiempo_prod");
        $this->hasMany('codigo_proveedor', 'AcBaremos', 'id_proveedor', ['alias' => 'AcBaremos']);
        $this->hasMany('codigo_proveedor', 'AcCartaAvalDetalle', 'codigo_proveedor', ['alias' => 'AcCartaAvalDetalle']);
        $this->hasMany('codigo_proveedor', 'AcClavesDetalle', 'codigo_proveedor', ['alias' => 'AcClavesDetalle']);
        $this->hasMany('codigo_proveedor', 'AcFacturas', 'codigo_proveedor_creador', ['alias' => 'AcFacturas']);
        $this->belongsTo('estado_id', '\AcEstados', 'id', ['alias' => 'AcEstados']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_proveedores_extranet';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcProveedoresExtranet[]|AcProveedoresExtranet
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcProveedoresExtranet
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
