<?php

class Funerario extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=20, nullable=false)
     */
    public $codigo_solicitud;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $estado_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $afiliado_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $ciudad;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $contacto;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $cobertura;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $metodo_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $plazo;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $doc_cedula;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $doc_acta;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $creador;

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
        $this->hasMany('id', 'FunerarioDetalle', 'funerario_id', ['alias' => 'FunerarioDetalle']);
        $this->belongsTo('estado_id', '\AcEstados', 'id', ['alias' => 'AcEstados']);
        $this->belongsTo('afiliado_id', '\AcAfiliados', 'id', ['alias' => 'AcAfiliados']);
        $this->belongsTo('metodo_id', '\MetodoPago', 'id', ['alias' => 'MetodoPago']);
        $this->belongsTo('creador', '\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'funerario';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Funerario[]|Funerario
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Funerario
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
