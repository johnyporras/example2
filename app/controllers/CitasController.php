<?php

class CitasController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listAllAction()
    {

        $response = $this->response;
        $request = $this->request;

        $lista = AcClaves::find([
            'conditions' => 'cedula_afiliado = :cedula:',
            'bind' => [
                'cedula' => $request->getPost('cedula')
            ]
        ]);

        foreach ( $lista as $item ){

            foreach ($item->AcClavesDetalle as $itemDetail) {
                
                $this->_detailClaves[] = [

                    'tipoServ' => AcServiciosExtranet::findFirstByCodigoServicio($itemDetail->codigo_servicio),

                    'proMedico' => AcProcedimientosMedicos::findFirst([
                        'conditions' => 'codigo_especialidad = :idCodEspc: AND codigo_servicio = :idCodServ:',
                        'bind' => [
                            'idCodServ' => $itemDetail->codigo_servicio,
                            'idCodEspc' => $itemDetail->codigo_especialidad
                        ]
                    ])
                ];

            }

            $this->_list[] = [

                'nombre' => $item->AcAfiliados->nombre,
                'fecha' => $item->fecha_cita,
                'clave' => $item->clave,
                'aja' => $item->AcClavesDetalle->toArray(),
                'detallesClave' => $this->_detailClaves,
                'proveedor' => $item->AcProveedoresExtranet->nombre,
                'especialidad' => AcEspecialidadesExtranet::findFirstByCodigoEspecialidad($item->acproveedoresextranet->codigo_especialidad)->descripcion

            ];

            $this->_detailClaves = [];

        }

        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $this->_list;
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
        ];

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function buscarAction()
    {

        $response = $this->response;
        $request = $this->request;

        $busqueda = AcProveedoresExtranet::find([
            'conditions' => 'nombre LIKE :value:',
            'bind' => [
                'value' => '%'.$request->getPost('val').'%'
            ]
        ]);

        foreach ( $busqueda as $item ){

            $this->_list[] = $item;

        }

        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $this->_list;
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
        ];

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function genClavAction()
    {

        $response = $this->response;
        $request = $this->request;
        $random = new \Phalcon\Security\Random();

        $objDatos =  json_decode( $request->getPost('obj') );

        $clave = new AcClaves();
        $clave->clave = AcClaves::claveRandom();
        $clave->cedula_afiliado = $objDatos->cedula_afiliado;
        $clave->codigo_contrato = $objDatos->codContra;
        $clave->fecha_cita = $objDatos->fecha_cita;
        $clave->motivo = $objDatos->motivo;
        $clave->observaciones = $objDatos->observaciones;
        $clave->costo_total = $objDatos->montoTotal;
        $clave->codigo_proveedor_creador = 0;
        $clave->correo = $objDatos->email;
        $clave->examen = null;
        $clave->estatus_clave = 5;
        $clave->creador = $this->session->get("id");
        $clave->telefono = $objDatos->telefono;
        $clave->rechazo = null;
        $clave->tipo_afiliado = $objDatos->tipoAfiliado;
        $clave->cantidad_servicios = $objDatos->cantServ;
        $clave->save();

        //aqui se mandan los detalles de los servicios que tienen que ver con la espacialidad, de igual forma estos valores los puedes chekr una vez se guarden

        foreach ($objDatos->detailClaveServ as $item ) {
            
            $claveDetalle = new AcClavesDetalle();
            $claveDetalle->id_clave = $clave->id;
            $claveDetalle->codigo_servicio = $item->tipoServ->codigo_servicio;
            $claveDetalle->codigo_especialidad = $objDatos->espec;
            $claveDetalle->id_procedimiento = $item->proMed->id;
            $claveDetalle->codigo_proveedor = $objDatos->proveedor->codigo_proveedor;
            $claveDetalle->costo = $item->monto;
            $claveDetalle->detalle = $objDatos->detailServ;
            $claveDetalle->save();

        }

        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $clave->clave;
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
        ];

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

}

