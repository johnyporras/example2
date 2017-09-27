<?php

class AcClavesDetalle extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_servicio;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_especialidad;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_procedimiento;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_proveedor;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $costo;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $detalle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $estatus;

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
        $this->belongsTo('codigo_servicio', '\AcServiciosExtranet', 'codigo_servicio', ['alias' => 'AcServiciosExtranet']);
        $this->belongsTo('codigo_especialidad', '\AcEspecialidadesExtranet', 'codigo_especialidad', ['alias' => 'AcEspecialidadesExtranet']);
        $this->belongsTo('id_clave', '\AcClaves', 'id', ['alias' => 'AcClaves']);
        $this->belongsTo('estatus', '\AcEstatusDetalle', 'id', ['alias' => 'AcEstatusDetalle']);
        $this->belongsTo('id_procedimiento', '\AcProcedimientosMedicos', 'id', ['alias' => 'AcProcedimientosMedicos']);
        $this->belongsTo('codigo_proveedor', '\AcProveedoresExtranet', 'codigo_proveedor', ['alias' => 'AcProveedoresExtranet']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_claves_detalle';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClavesDetalle[]|AcClavesDetalle
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClavesDetalle
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
