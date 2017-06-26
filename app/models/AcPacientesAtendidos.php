<?php

class AcPacientesAtendidos extends \Phalcon\Mvc\Model
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
    public $tipo_autorizacion;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $cedula_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_clave_detalle;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_atencion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $patologia;

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
        $this->belongsTo('cedula_afiliado', '\AcAfiliados', 'cedula', ['alias' => 'AcAfiliados']);
        $this->belongsTo('tipo_autorizacion', '\AcTipoAutorizacion', 'id', ['alias' => 'AcTipoAutorizacion']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_pacientes_atendidos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcPacientesAtendidos[]|AcPacientesAtendidos
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcPacientesAtendidos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
