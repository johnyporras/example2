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
     * @Column(type="string", length=255, nullable=true)
     */
    public $observacion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $preferido;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fechacita;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $rangohoracita;

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
     * Initialize method for model.
     */
    public function initialize()
    {
      //  $this->setSchema("public");
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
