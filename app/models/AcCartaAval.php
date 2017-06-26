<?php

class AcCartaAval extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=100, nullable=true)
     */
    public $clave;

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
     * @Column(type="string", nullable=true)
     */
    public $fecha_solicitud;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_emision;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $motivo;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $diagnostico;

    /**
     *
     * @var double
     * @Column(type="double", length=12, nullable=true)
     */
    public $costo_total;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $documentos;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $estatus;

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
    public $creador;

    /**
     *
     * @var string
     * @Column(type="string", length=75, nullable=true)
     */
    public $telefono;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $rechazo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $cantidad_servicios;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $tipo_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_autorizacion;

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
    public $id_factura;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("atiempo_dev");
        $this->belongsTo('estatus', '\AcEstatus', 'id', ['alias' => 'AcEstatus']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_carta_aval';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCartaAval[]|AcCartaAval
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCartaAval
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
