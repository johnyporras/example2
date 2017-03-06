<?php

use Phalcon\Security\Random;

class ViajesController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listAllAction()
    {

        $response = $this->response;
        $request = $this->request;

        $lista = Avi::find();

        /*::find([
            'conditions' => 'nombre LIKE :value:',
            'bind' => [
                'value' => '%'.$request->getPost('val').'%'
            ]
        ]);*/



        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $lista;
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

    public function genViajeAction()
    {
        $random = new Random();
        $response = $this->response;
        $request = $this->request;

        $objAfiliado = json_decode($request->getPost('afiliado'));
        $objcontrato = json_decode($request->getPost('contrato'));
        $edadAfiliado = date('Y-m-d') - $objAfiliado->fecha_nacimiento;
        $coberMonto = 1;
        $codSolicitud = $random->number(9999999);
        $objViajes = json_decode($request->getPost('viajes'));
        $observacines = $request->getPost('observ');
        $cronograma = $request->getPost('cronograma');

        $avi = new Avi();
        $avi->codigo_solicitud = $codSolicitud;
        $avi->cedula_afiliado = $objcontrato->cedula_afiliado;
        $avi->codigo_contrato = $objcontrato->codigo_contrato;
        $avi->cobertura_monto = $coberMonto;
        $avi->edad_afiliado = $edadAfiliado;
        $avi->nro_cronograma = $cronograma;
        $avi->observaciones = $observacines;
        $avi->creador = 1;
        $avi->save();

        foreach( $objViajes as $item ){

            $aviDestino = new AviDestino();
            $aviDestino->codigo_solicitud_avi = $avi->id;
            $aviDestino->pais_destino = $item->pais;
            $aviDestino->fecha_desde = $item->desde;
            $aviDestino->fecha_hasta = $item->hasta;
            $aviDestino->save();

        }


        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $objcontrato;
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

