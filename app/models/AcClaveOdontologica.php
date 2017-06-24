<?php

class AcClaveOdontologica extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $tipo_control;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $cedula_afiliado;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $codigo_contrato;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
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
     * @Column(type="string", length=100, nullable=true)
     */
    public $clave_primaria;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $motivo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $codigo_proveedor_creador;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $estatus;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $creador;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
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
     * @Column(type="integer", length=32, nullable=true)
     */
    public $numero_control;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("atiempo_dev");
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

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClaveOdontologica[]|AcClaveOdontologica
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
