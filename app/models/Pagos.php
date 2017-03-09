<?php

class Pagos extends \Phalcon\Mvc\Model
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
    public $user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $mes;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $ano;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $monto;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_corte;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $numero_factura;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_factura;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_recibo_factura;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_pago;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $numero_deposito;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $status;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_creacion;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $retencion;

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
        return 'pagos';
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
     * @return Pagos[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pagos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
