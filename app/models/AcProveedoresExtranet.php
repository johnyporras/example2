<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class AcProveedoresExtranet extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=100, nullable=false)
     */
    public $codigo_proveedor;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $cedula;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $nombre;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_nacimiento;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_especialidad;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $direccion;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $telefono_casa;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $telefono_movil;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $urbanizacion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_estado;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $ciudad;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $email;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $colegiatura;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $msas;

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
        $this->setSchema("altocentro");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_proveedores_extranet';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcProveedoresExtranet[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcProveedoresExtranet
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
