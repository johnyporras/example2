<?php

class AcCitasOdontologicas extends \Phalcon\Mvc\Model
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
    public $id_paciente;

    /**
     *
     * @var string
     */
    public $clave;

    /**
     *
     * @var string
     */
    public $fecha1;

    /**
     *
     * @var string
     */
    public $fecha2;

    /**
     *
     * @var string
     */
    public $fecha3;

    /**
     *
     * @var integer
     */
    public $estatus;

    /**
     *
     * @var string
     */
    public $fecha_creacion;

    /**
     *
     * @var string
     */
    public $fecha_modifico;

    /**
     *
     * @var integer
     */
    public $usuario_creador;

    /**
     *
     * @var integer
     */
    public $usuario_modifico;

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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_citas_odontologicas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCitasOdontologicas[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCitasOdontologicas
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
