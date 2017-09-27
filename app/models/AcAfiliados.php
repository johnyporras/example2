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
     * @Column(type="string", length=255, nullable=false)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $apellido;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_nacimiento;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    public $sexo;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $telefono;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_cuenta;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_estado;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $ciudad;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $civil;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $hijos;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $ocupacion;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $idioma;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $altura;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $peso;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $grupo_sangre;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $lentes;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $condicion_lentes;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $menstruacion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $abortos;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $partos;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $cesarea;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $perdidas;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $embarazada;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $tiempo_gestacion;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSchema("public");
        $this->hasMany('id', 'AcDocumentos', 'id_afiliado', ['alias' => 'AcDocumentos']);
        $this->hasMany('id', 'Avi', 'afiliado_id', ['alias' => 'Avi']);
        $this->hasMany('id', 'Contactos', 'id_afiliado', ['alias' => 'Contactos']);
        $this->hasMany('id', 'Funerario', 'afiliado_id', ['alias' => 'Funerario']);
        $this->hasMany('id', 'HistorialMedico', 'id_afiliado', ['alias' => 'HistorialMedico']);
        $this->hasMany('id', 'Medicamentos', 'id_afiliado', ['alias' => 'Medicamentos']);
        $this->hasMany('id', 'MotivoDetalles', 'id_afiliado', ['alias' => 'MotivoDetalles']);
        $this->belongsTo('id_cuenta', '\AcCuenta', 'id', ['alias' => 'AcCuenta']);
        $this->belongsTo('id_estado', '\AcEstados', 'id', ['alias' => 'AcEstados']);
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
