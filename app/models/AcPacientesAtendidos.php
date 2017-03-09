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
    public $id_titular;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_paciente;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $telefono;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $tipo;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $procedimiento;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_profesional;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_aseguradora;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_colectivo;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    public $monto;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $motivo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $servicio;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $patologia;

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
        return 'ac_pacientes_atendidos';
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
     * @return AcPacientesAtendidos[]
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
