<?php

class HistorialMedico extends \Phalcon\Mvc\Model
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
    public $id_user;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $motivo;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $especialidad;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tratamiento;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $procedimiento;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $medico;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $observaciones;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $recomendaciones;

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
        $this->hasMany('id', 'HistorialExamenes', 'id_historial', ['alias' => 'HistorialExamenes']);
        $this->belongsTo('id_user', '\Users', 'id', ['alias' => 'Users']);
        $this->belongsTo('id_afiliado', '\AcAfiliados', 'id', ['alias' => 'AcAfiliados']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'historial_medico';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HistorialMedico[]|HistorialMedico
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HistorialMedico
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    
   

}
