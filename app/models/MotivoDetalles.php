<?php

class MotivoDetalles extends \Phalcon\Mvc\Model
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
    public $id_motivo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tipo;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $cantidad;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $frecuencia;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $causa;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tratamiento;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $profecional;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $comentarios;

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
        $this->belongsTo('id_motivo', '\Motivos', 'id', ['alias' => 'Motivos']);
        $this->belongsTo('id_afiliado', '\AcAfiliados', 'id', ['alias' => 'AcAfiliados']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'motivo_detalles';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MotivoDetalles[]|MotivoDetalles
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MotivoDetalles
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
