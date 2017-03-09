<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class PasswordResets extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $token;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $created_at;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Email(
                [
                    'field'    => 'email',
                    'required' => true,
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }

        return true;
    }

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
        return 'password_resets';
    }

    public function beforeCreate()
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PasswordResets[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PasswordResets
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
