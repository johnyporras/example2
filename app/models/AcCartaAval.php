<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class AcCartaAval extends \Phalcon\Mvc\Model
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
    public $codigo_contrato;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $cedula_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_solicitud;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $fecha_emision;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $motivo_consulta;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    public $codigo_especialidad;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $diagnostico;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $codigo_examen;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $email;

    /**
     *
     * @var double
     * @Column(type="double", length=12, nullable=true)
     */
    public $monto;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    public $documentos;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $estatus;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $codigo_proveedor;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    public $clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $creador;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hora_guardado;

    /**
     *
     * @var string
     * @Column(type="string", length=75, nullable=true)
     */
    public $telefono;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $rechazo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $cantidad_servicios;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $tipo_afiliado;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hora_autorizacion;

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
        $this->setSchema("altocentroTest");
        $this->belongsTo('cedula_afiliado', 'AcAfiliados', 'cedula', ['alias' => 'AcAfiliados']);
        $this->belongsTo('codigo_contrato', 'AcContratos', 'codigo_contrato', ['alias' => 'AcContratos']);
        $this->belongsTo('codigo_especialidad', 'AcEspecialidadesExtranet', 'codigo_especialidad', ['alias' => 'AcEspecialidadesExtranet']);
        $this->belongsTo('codigo_proveedor', 'AcProveedoresExtranet', 'codigo_proveedor', ['alias' => 'AcProveedoresExtranet']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_carta_aval';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCartaAval[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcCartaAval
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
