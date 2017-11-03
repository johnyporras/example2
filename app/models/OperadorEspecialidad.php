<?php

class OperadorEspecialidad extends \Phalcon\Mvc\Model
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
    public $id_operador;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $id_epecialidad;

    /**
     * Initialize method for model.
     */
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
        $this->belongsTo('id_especialidad', '\Especialidad', 'id', ['alias' => 'Especialidad']);
        $this->belongsTo('id_operador', '\Operador', 'id', ['alias' => 'Operador']);
        return 'operador_especialidad';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Terminos[]|Terminos
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Terminos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
