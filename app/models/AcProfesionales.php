<?php

class AcProfesionales extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    public $acp_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $acp_es_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $acp_ciudad;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $acp_direccion;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acp_profesional;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $acp_telefono;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $acp_acr_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $acp_ace_id;

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
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_profesionales';
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
     * @return AcProfesionales[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcProfesionales
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
