<?php

class AcMascotas extends \Phalcon\Mvc\Model
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
    public $id_cuenta;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $tipo;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $raza;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $tamano;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $color_pelage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $edad;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_nac;

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
    public $deleted_at;

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
        $this->setSchema("atiempo_dev");
        $this->belongsTo('id_cuenta', '\AcCuenta', 'id', ['alias' => 'AcCuenta']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_mascotas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcMascotas[]|AcMascotas
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcMascotas
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
