<?php

class AcClavedetalleprov extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_proveedor;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $aceptado;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    public $observacion;

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
     * @Column(type="date", nullable=true)
     */
    public $fechacita;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $horacita;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    public $direccion;

    /**
     *
     * @var string
     * @Column(type="integer", nullable=true)
     */
    public $preferido;

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
        return 'ac_clavedetalleprov';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClavedetalleprov[]|AcClavedetalleprov
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClavedetalleprov
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
