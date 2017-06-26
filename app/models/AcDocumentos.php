<?php

class AcDocumentos extends \Phalcon\Mvc\Model
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
    public $id_paciente;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_tipo_documento;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $file;

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
        $this->belongsTo('id_paciente', '\AcPacientesAtendidos', 'id', ['alias' => 'AcPacientesAtendidos']);
        $this->belongsTo('id_tipo_documento', '\AcTipoDocumentos', 'id', ['alias' => 'AcTipoDocumentos']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_documentos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcDocumentos[]|AcDocumentos
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcDocumentos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
