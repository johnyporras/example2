<?php

class AcCartaAvalDetalle extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $id_carta;

    /**
     *
     * @var integer
     */
    public $codigo_servicio;

    /**
     *
     * @var integer
     */
    public $codigo_especialidad;

    /**
     *
     * @var integer
     */
    public $id_procedimiento;

    /**
     *
     * @var integer
     */
    public $codigo_proveedor;

    /**
     *
     * @var double
     */
    public $costo;

    /**
     *
     * @var string
     */
    public $detalle;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var string
     */
    public $deleted_at;

    /**
     *
     * @var integer
     */
    public $estatus;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_carta_aval_detalle';
    }

    public function beforeCreate()
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCartaAvalDetalle[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCartaAvalDetalle
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
