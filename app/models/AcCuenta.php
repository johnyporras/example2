<?php

class AcCuenta extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=50, nullable=true)
     */
    public $codigo_cuenta;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_producto;

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
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $estatus;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("atiempo_dev");
        $this->belongsTo('estatus', '\EstatusCuenta', 'id', ['alias' => 'EstatusCuenta']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_cuenta';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCuenta[]|AcCuenta
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCuenta
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
