<?php

class BloqueHorario extends \Phalcon\Mvc\Model
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
    public $hora;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $turno;


    public function initialize()
    {
        $this->setSchema("atiempo_prod");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'bloquehorario';
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
