<?php

class AcCitas extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $acc_id;

    /**
     *
     * @var string
     */
    public $acc_cita;

    /**
     *
     * @var string
     */
    public $acc_titular;

    /**
     *
     * @var string
     */
    public $acc_cedula_tit;

    /**
     *
     * @var string
     */
    public $acc_beneficiario;

    /**
     *
     * @var string
     */
    public $acc_cedula_ben;

    /**
     *
     * @var string
     */
    public $acc_email;

    /**
     *
     * @var string
     */
    public $acc_estado;

    /**
     *
     * @var string
     */
    public $acc_ciudad;

    /**
     *
     * @var string
     */
    public $acc_direccion;

    /**
     *
     * @var string
     */
    public $acc_telefono;

    /**
     *
     * @var string
     */
    public $acc_movil;

    /**
     *
     * @var string
     */
    public $acc_fecha_sol;

    /**
     *
     * @var integer
     */
    public $acc_especialidad;

    /**
     *
     * @var string
     */
    public $acc_horario;

    /**
     *
     * @var integer
     */
    public $acc_tipo_cita;

    /**
     *
     * @var string
     */
    public $acc_status;

    /**
     *
     * @var string
     */
    public $acc_aseguradora;

    /**
     *
     * @var string
     */
    public $acc_trabajo;

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
        return 'ac_citas';
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
     * @return AcCitas[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCitas
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
