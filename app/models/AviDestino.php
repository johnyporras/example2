<?php

class AviDestino extends \Phalcon\Mvc\Model
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
    public $avi_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $pais_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_desde;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_hasta;

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
        $this->belongsTo('avi_id', '\Avi', 'id', ['alias' => 'Avi']);
        $this->belongsTo('pais_id', '\Paises', 'id', ['alias' => 'Paises']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'avi_destino';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AviDestino[]|AviDestino
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AviDestino
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
