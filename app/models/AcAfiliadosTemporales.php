<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class AcAfiliadosTemporales extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $cedula;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $apellido;

    /**
     *
     * @var string
     */
    public $fecha_nacimiento;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $sexo;

    /**
     *
     * @var string
     */
    public $val_user;

    /**
     *
     * @var integer
     */
    public $tipo_afiliado;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $nombre_titular;

    /**
     *
     * @var string
     */
    public $apellido_titular;

    /**
     *
     * @var string
     */
    public $cedula_titular;

    /**
     *
     * @var integer
     */
    public $codigo_aseguradora;

    /**
     *
     * @var integer
     */
    public $codigo_colectivo;

    /**
     *
     * @var integer
     */
    public $estado;

    /**
     *
     * @var string
     */
    public $ciudad;

    /**
     *
     * @var integer
     */
    public $tipo_creador;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var string
     */
    public $deleted_at;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }

        return true;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_afiliados_temporales';
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
     * @return AcAfiliadosTemporales[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcAfiliadosTemporales
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
