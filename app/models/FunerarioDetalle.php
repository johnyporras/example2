<?php

class FunerarioDetalle extends \Phalcon\Mvc\Model
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
    public $funerario_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $proveedor_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $factura;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $monto;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $detalles;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $doc_factura;

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
        $this->setSchema("atiempo_prod");
        $this->belongsTo('proveedor_id', '\ProveedorFunerario', 'id', ['alias' => 'ProveedorFunerario']);
        $this->belongsTo('funerario_id', '\Funerario', 'id', ['alias' => 'Funerario']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'funerario_detalle';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return FunerarioDetalle[]|FunerarioDetalle
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return FunerarioDetalle
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
