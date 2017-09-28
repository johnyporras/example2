<?php

class AcProcedimientosMedicos extends \Phalcon\Mvc\Model
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
    public $codigo_examen;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $codigo_especialidad;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $codigo_servicio;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $tipo_examen;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $orden;

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
        $this->setSchema("atiempo_dev");
        $this->hasMany('id', 'AcBaremos', 'id_procedimiento', ['alias' => 'AcBaremos']);
        $this->hasMany('id', 'AcCartaAvalDetalle', 'id_procedimiento', ['alias' => 'AcCartaAvalDetalle']);
        $this->hasMany('id', 'AcClavesDetalle', 'id_procedimiento', ['alias' => 'AcClavesDetalle']);
        $this->belongsTo('codigo_servicio', '\AcServiciosExtranet', 'codigo_servicio', ['alias' => 'AcServiciosExtranet']);
        $this->belongsTo('codigo_especialidad', '\AcEspecialidadesExtranet', 'codigo_especialidad', ['alias' => 'AcEspecialidadesExtranet']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_procedimientos_medicos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcProcedimientosMedicos[]|AcProcedimientosMedicos
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcProcedimientosMedicos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
