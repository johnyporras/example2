<?php

class AcEspecialidadesExtranet extends \Phalcon\Mvc\Model
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
    public $codigo_especialidad;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $rama;

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
        $this->setSchema("public");
        $this->hasMany('codigo_especialidad', 'AcCartaAvalDetalle', 'codigo_especialidad', ['alias' => 'AcCartaAvalDetalle']);
        $this->hasMany('codigo_especialidad', 'AcClavesDetalle', 'codigo_especialidad', ['alias' => 'AcClavesDetalle']);
        $this->hasMany('codigo_especialidad', 'AcCoberturaExtranet', 'id_especialidad', ['alias' => 'AcCoberturaExtranet']);
        $this->hasMany('codigo_especialidad', 'AcProcedimientosMedicos', 'codigo_especialidad', ['alias' => 'AcProcedimientosMedicos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_especialidades_extranet';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcEspecialidadesExtranet[]|AcEspecialidadesExtranet
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcEspecialidadesExtranet
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
