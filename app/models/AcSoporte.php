<?php

class AcSoporte extends \Phalcon\Mvc\Model
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
    public $codigo_user;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $solicitud;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $respuesta;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_creacion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_respuesta;

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
        return 'ac_soporte';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcSoporte[]|AcSoporte
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcSoporte
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
