<?php

class AcTratamientoOdontologico extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_procedimiento;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_diente;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_ubicacion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_atencion;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $observaciones;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $estatus;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $creador;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $telefono;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $doc1;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
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
        return 'ac_tratamiento_odontologico';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcTratamientoOdontologico[]|AcTratamientoOdontologico
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
