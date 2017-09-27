<?php

class Medicamentos extends \Phalcon\Mvc\Model
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
    public $id_tipo_medicamento;

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
    public $nombre;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $dosis;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $frecuencia;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $duracion;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $diagnostico;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $recetado;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $file;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_inicio;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_fin;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hora;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $mensaje;

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
        $this->belongsTo('id_afiliado', '\AcAfiliados', 'id', ['alias' => 'AcAfiliados']);
        $this->belongsTo('id_tipo_medicamento', '\TipoMedicamentos', 'id', ['alias' => 'TipoMedicamentos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'medicamentos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Medicamentos[]|Medicamentos
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Medicamentos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
