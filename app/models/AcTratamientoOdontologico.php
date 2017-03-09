<?php

class AcTratamientoOdontologico extends \Phalcon\Mvc\Model
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
    public $id_clave;

    /**
     *
     * @var integer
     */
    public $id_procedimiento;

    /**
     *
     * @var integer
     */
    public $id_diente;

    /**
     *
     * @var integer
     */
    public $id_ubicacion;

    /**
     *
     * @var string
     */
    public $fecha_atencion;

    /**
     *
     * @var string
     */
    public $observaciones;

    /**
     *
     * @var integer
     */
    public $estatus;

    /**
     *
     * @var integer
     */
    public $creador;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $doc1;

    /**
     *
     * @var string
     */
    public $doc2;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("atiempo_dev");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_tratamiento_odontologico';
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
     * @return AcTratamientoOdontologico[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcTratamientoOdontologico
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
