<?php

class AcDetprogpago extends \Phalcon\Mvc\Model
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
    public $id_factura;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $montofact;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $montoimp1;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $montoimp2;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $montoimp3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $estatus;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_progpago;

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
        $this->setSchema("public");
        $this->belongsTo('id_progpago', '\AcProgpago', 'id', ['alias' => 'AcProgpago']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_detprogpago';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcDetprogpago[]|AcDetprogpago
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcDetprogpago
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
