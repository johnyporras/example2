<?php

class Avi extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=30, nullable=false)
     */
    public $codigo_solicitud;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $cedula_afiliado;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $codigo_contrato;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $cobertura_monto;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $edad_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $nro_cronograma;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $observaciones;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $creador;

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
        return 'avi';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Avi[]|Avi
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Avi
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
