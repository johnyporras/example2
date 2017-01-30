<?php

class CitasController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';

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

        $objDatos =  json_decode( $request->getPost('obj') );

        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $objDatos;
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

