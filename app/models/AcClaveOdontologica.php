<?php

class AcClaveOdontologica extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $clave;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $tipo_control;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $cedula_afiliado;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_contrato;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_atencion1;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_atencion2;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_atencion3;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $clave_primaria;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $motivo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_proveedor_creador;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $numero_control;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $creador;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $telefono;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $deleted_at;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $estatus;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("altocentroTest");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_clave_odontologica';
    }

    public function beforeCreate()
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClaveOdontologica[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClaveOdontologica
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
