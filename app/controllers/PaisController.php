<?php

class PaisController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listAllAction()//metodo del controlador que retorna un array con todos los paises, no requiere de token de validacion...ruta de acceso '/pais-list' via get
    {

        $response = $this->response;
        $request = $this->request;

        $lista = Paises::find();//obtiene el array con los paises

        foreach($lista as $item){

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

}

