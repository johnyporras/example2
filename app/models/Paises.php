<?php

class Paises extends \Phalcon\Mvc\Model
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
    public $code;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $codigo;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $name_es;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $name_en;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
      //  $this->setSchema("public");
        $this->hasMany('id', 'AviDestino', 'pais_id', ['alias' => 'AviDestino']);
        $this->hasMany('id', 'Terminos', 'pais_id', ['alias' => 'Terminos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'paises';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Paises[]|Paises
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Paises
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
