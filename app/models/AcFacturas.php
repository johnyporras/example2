<?php

class AcFacturas extends \Phalcon\Mvc\Model
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
    public $numero_factura;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $numero_control;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_factura;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    public $monto;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $observaciones;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_creacion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $usuario_creador;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_estatus;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $documento;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_proveedor_creador;

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
        $this->setSchema("public");
        $this->belongsTo('codigo_estatus', '\AcEstatus', 'id', ['alias' => 'AcEstatus']);
        $this->belongsTo('codigo_proveedor_creador', '\AcProveedoresExtranet', 'codigo_proveedor', ['alias' => 'AcProveedoresExtranet']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_facturas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcFacturas[]|AcFacturas
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcFacturas
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
