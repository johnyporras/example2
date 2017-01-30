<?php

class ProcedimientosMedicosController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';

    public function allAction()
    {

        $response = $this->response;
        $request = $this->request;

        $procMedicos = AcProcedimientosMedicos::find();

        foreach ( $procMedicos as $item ){

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

    public function listAction()
    {

        $response = $this->response;
        $request = $this->request;

        $procMedicos = AcProcedimientosMedicos::find([
            'conditions' => 'codigo_servicio = :serv: AND codigo_especialidad = :espec:',
            'bind' => [
                'serv' => $request->getPost('serv'),
                'espec' => $request->getPost('espec')
            ]
        ]);

        foreach ( $procMedicos as $item ){

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
            "data" => $this->_data
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function montoAction()
    {

        $response = $this->response;
        $request = $this->request;

        $montoBaremos = AcBaremos::findFirst([
            'conditions' => 'id_procedimiento = :idProc: AND id_proveedor = :idProv:',
            'bind' => [
                'idProc' => $request->getPost('idProc'),
                'idProv' => $request->getPost('idProv')
            ]
        ]);

        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $montoBaremos->monto;
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
        ];

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

}

