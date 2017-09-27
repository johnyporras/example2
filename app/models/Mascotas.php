<?php

class Mascotas extends \Phalcon\Mvc\Model
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
    public $cuenta_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $tamano_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $raza;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $color_pelage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $edad;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $tipo;

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
      //  $this->setSchema("public");
        $this->belongsTo('cuenta_id', '\AcCuenta', 'id', ['alias' => 'AcCuenta']);
        $this->belongsTo('tamano_id', '\Tamanos', 'id', ['alias' => 'Tamanos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mascotas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mascotas[]|Mascotas
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Mascotas
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
