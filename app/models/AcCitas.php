<?php

class AcCitas extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    public $acc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $acc_cita;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acc_titular;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $acc_cedula_tit;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acc_beneficiario;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=false)
     */
    public $acc_cedula_ben;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $acc_email;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $acc_estado;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $acc_ciudad;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acc_direccion;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $acc_telefono;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acc_movil;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $acc_fecha_sol;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $acc_especialidad;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=false)
     */
    public $acc_horario;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $acc_tipo_cita;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    public $acc_status;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acc_aseguradora;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acc_trabajo;

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
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_citas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCitas[]|AcCitas
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
