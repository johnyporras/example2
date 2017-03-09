<?php

class AcTratamientosOdontologicos extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $tratamiento_realizado;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_tratamiento;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $dientes;

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
    public $fecha_creacion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_modifico;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $usuario_creador;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $usuario_modifico;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $rechazo;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $doc1;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $doc2;

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
        return 'ac_tratamientos_odontologicos';
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
     * @return AcTratamientosOdontologicos[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcTratamientosOdontologicos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
