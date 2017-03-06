<?php

class Avi extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $codigo_solicitud;

    /**
     *
     * @var integer
     */
    public $cedula_afiliado;

    /**
     *
     * @var integer
     */
    public $codigo_contrato;

    /**
     *
     * @var string
     */
    public $cobertura_monto;

    /**
     *
     * @var integer
     */
    public $edad_afiliado;

    /**
     *
     * @var string
     */
    public $nro_cronograma;

    /**
     *
     * @var string
     */
    public $observaciones;

    /**
     *
     * @var integer
     */
    public $creador;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var string
     */
    public $deleted_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("altocentro");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'avi';
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
     * @return Avi[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Avi
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
