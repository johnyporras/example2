<?php

class AcServiciosExtranet extends \Phalcon\Mvc\Model
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
    public $codigo_servicio;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $descripcion;

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
        $this->hasMany('codigo_servicio', 'AcCartaAvalDetalle', 'codigo_servicio', ['alias' => 'AcCartaAvalDetalle']);
        $this->hasMany('codigo_servicio', 'AcClavesDetalle', 'codigo_servicio', ['alias' => 'AcClavesDetalle']);
        $this->hasMany('codigo_servicio', 'AcCoberturaExtranet', 'id_servicio', ['alias' => 'AcCoberturaExtranet']);
        $this->hasMany('codigo_servicio', 'AcProcedimientosMedicos', 'codigo_servicio', ['alias' => 'AcProcedimientosMedicos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_servicios_extranet';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcServiciosExtranet[]|AcServiciosExtranet
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcServiciosExtranet
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
