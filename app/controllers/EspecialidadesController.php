<?php

class EspecialidadesController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';

    public function allAction()
    {

        $response = $this->response;
        $request = $this->request;

        $especialidades = AcEspecialidadesExtranet::find();

        foreach ( $especialidades as $item ){

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

        $ramo = AcRamo::findFirstByacrDesc($request->getPost('acrDesc'));

        $especialidades = AcEspecialidadesExtranet::find([
            'conditions' => 'rama = :acr_id:',
            'bind' => [
                'acr_id' => $ramo->acr_id
            ]
        ]);

        foreach ( $especialidades as $item ){

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

