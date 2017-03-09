<?php

class AcClavesDetalle extends \Phalcon\Mvc\Model
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
    public $id_clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_especialidad;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_servicio;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_procedimiento;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_examen;

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
        $this->setSchema("atiempo_dev");
        $this->belongsTo('id', 'AcProcedimientosMedicos', 'id_procedimiento', ['alias' => 'AcProcedimientosMedicos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_claves_detalle';
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
     * @return AcClavesDetalle[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Lista de detalles de clave por el id de la clave
     *
     * @param mixed $parameters
     * @return AcClavesDetalle
     */
    public static function detailCLave($parameters = null)
    {

        $dc = self::find([
            'conditions' => 'id_clave = :idClave:',
            'bind' => [
                'idClave' => $parameters
            ]
        ]);

        return $dc;
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClavesDetalle
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
