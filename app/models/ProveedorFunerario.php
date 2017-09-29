<?php

class ProveedorFunerario extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=255, nullable=false)
     */
    public $codigo;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $razon_social;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $rif;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $direccion;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $telefono;

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
        $this->setSchema("atiempo_prod");
        $this->hasMany('id', 'FunerarioDetalle', 'proveedor_id', ['alias' => 'FunerarioDetalle']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'proveedor_funerario';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProveedorFunerario[]|ProveedorFunerario
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProveedorFunerario
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
