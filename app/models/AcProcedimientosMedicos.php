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
     * @Column(type="string", length=100, nullable=false)
     */
    public $tipo_examen;

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
        $this->belongsTo('codigo_especialidad', '\AcEspecialidadesExtranet', 'codigo_especialidad', ['alias' => 'AcEspecialidadesExtranet']);
        $this->belongsTo('codigo_servicio', '\AcServiciosExtranet', 'codigo_servicio', ['alias' => 'AcServiciosExtranet']);
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
