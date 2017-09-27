<?php

class AcCuentaplan extends \Phalcon\Mvc\Model
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
    public $id_cuenta;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_plan;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $costo;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
      //  $this->setSchema("public");
        $this->belongsTo('id_plan', '\AcPlanesExtranet', 'codigo_plan', ['alias' => 'AcPlanesExtranet']);
        $this->belongsTo('id_cuenta', '\AcCuenta', 'id', ['alias' => 'AcCuenta']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_cuentaplan';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCuentaplan[]|AcCuentaplan
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCuentaplan
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
