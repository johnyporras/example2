<?php

class Submodules extends \Phalcon\Mvc\Model
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
     * @Column(type="string", nullable=false)
     */
    public $description;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $modules_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $order;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $url2;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $url3;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $url4;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $url5;

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
        $this->setSchema("atiempo_prod");
        $this->hasMany('id', 'TypesProfile', 'id_module', ['alias' => 'TypesProfile']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'submodules';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Submodules[]|Submodules
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Submodules
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
