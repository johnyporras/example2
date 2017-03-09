<?php

class AcCobertura extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=255, nullable=false)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $desc;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=false)
     */
    public $slogan;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $img;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $banner;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $icon;

    /**
     *
     * @var string
     * @Column(type="string", length=8, nullable=false)
     */
    public $color;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $orden;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    public $act;

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
        return 'ac_cobertura';
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
     * @return AcCobertura[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCobertura
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
