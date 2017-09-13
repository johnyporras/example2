<?php

class AcPlanesExtranet extends \Phalcon\Mvc\Model
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
    public $codigo_plan;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $cobertura;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $orden;

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
        $this->setSchema("public");
        $this->hasMany('codigo_plan', 'AcCoberturaExtranet', 'id_plan', ['alias' => 'AcCoberturaExtranet']);
        $this->hasMany('codigo_plan', 'AcCuentaplan', 'id_plan', ['alias' => 'AcCuentaplan']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_planes_extranet';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcPlanesExtranet[]|AcPlanesExtranet
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcPlanesExtranet
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
