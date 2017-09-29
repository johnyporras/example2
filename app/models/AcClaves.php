<?php

class AcClaves extends \Phalcon\Mvc\Model
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
    public $clave;

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
    public $fecha_cita;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $motivo;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $observaciones;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    public $costo_total;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_proveedor_creador;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $correo;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $examen;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $estatus_clave;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $creador;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=true)
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
    public $tipo_afiliado;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $cantidad_servicios;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hora_autorizado;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_factura;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $codigo_contrato;

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
        $this->hasMany('id', 'AcClavesDetalle', 'id_clave', ['alias' => 'AcClavesDetalle']);
        $this->belongsTo('estatus_clave', '\AcEstatus', 'id', ['alias' => 'AcEstatus']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ac_claves';
    }

    /**
     * retorna un radom para la clave
     *
     * @param mixed $length
     * @return randomString|AcClaves
     */
    public static function claveRandom($length = 7)
    {
        $characteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characteresLength = strlen($characteres);
        $randomString = '';
        for ($i=0; $i < $length; $i++) {

            $randomString .= $characteres[rand(0, $characteresLength - 1)];

        }
        return $randomString;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClaves[]|AcClaves
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AcClaves
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
