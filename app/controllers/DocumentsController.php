<?php

class DocumentsController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';

    public function listAction()
    {

    	$response = $this->response;
        $request = $this->request;

        $docs = AcDocumentos::find([
            'conditions' => 'id_paciente = :idPaciente:',
            'bind' => [
                'idPaciente' => 1
            ]
        ]);

        foreach ($docs as $item) {
        	
        	$this->_list[] = $item;

        }

        $status = 200;
        $msnStatus = 'OK';
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
        ];

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "datos" => $this->_list,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

}

