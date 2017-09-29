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
     * @Column(type="string", length=30, nullable=false)
     */
    public $codigo_cuenta;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha;

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
    public $id_producto;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $acepto_terminos;

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
        $this->hasMany('id', 'AcAfiliados', 'id_cuenta', ['alias' => 'AcAfiliados']);
        $this->hasMany('id', 'AcCuentaplan', 'id_cuenta', ['alias' => 'AcCuentaplan']);
        $this->hasMany('id', 'Mascotas', 'cuenta_id', ['alias' => 'Mascotas']);
        $this->hasMany('id', 'Pagos', 'cuenta_id', ['alias' => 'Pagos']);
        $this->belongsTo('id_producto', '\AcProducto', 'id', ['alias' => 'AcProducto']);
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
