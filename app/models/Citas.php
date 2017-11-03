<?php

class Citas extends \Phalcon\Mvc\Model
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
    public $id_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $id_operador_especialidad;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */

    public $fecha;

    public $id_bloque;

    public $estatus;

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


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("atiempo_prod");
        $this->belongsTo('id_afiliado', '\AcAfiliados', 'id', ['alias' => 'AcAfiliados']);
        $this->belongsTo('id_bloque', '\BloqueHorario', 'id', ['alias' => 'BloqueHorario']);
        $this->belongsTo('id_operador_especialidad', '\OperadorEspecialidad', 'id', ['alias' => 'OperadorEspecialidad']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'citas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contactos[]|Contactos
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contactos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
