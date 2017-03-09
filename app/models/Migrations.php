<?php

class Migrations extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $migration;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $batch;

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
        return 'migrations';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Migrations[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Migrations
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
