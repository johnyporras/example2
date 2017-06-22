<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class AcAfiliados extends \Phalcon\Mvc\Model
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
    public $cedula;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    public $apellido;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $fecha_nacimiento;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    public $sexo;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $telefono;

    /**
     *
     * @var integer
     * @Column(type="integer", nullable=false)
     */
    public $id_cuenta;

    /**
     *
     * @var integer
     * @Column(type="integer", nullable=false)
     */
    public $id_estado;

    /**
     *
     * @var string
     * @Column(type="string",lenght="255", nullable=false)
     */
    public $ciudad;

    /**
     *
     * @var string
     * @Column(type="string",lenght="255", nullable=true)
     */
    public $embarazada;

    /**
     *
     * @var integer
     * @Column(type="integer", nullable=true)
     */
    public $tiempo_gestacion;

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
        //$this->belongsTo('tipo_afiliado', 'AcTipoAfiliado', 'id', ['alias' => 'AcTipoAfiliado']);
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_afiliados';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcAfiliados[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcAfiliados
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
