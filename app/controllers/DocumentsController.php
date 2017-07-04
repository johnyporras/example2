<?php

class DocumentsController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';

    public function listAction()//metodod el controlador que retorna un array con la lista de documentos de un paciente a travez de un valor por defecto '1', no requiere token de validacion...ruta de acceso '/docs-list' via get
    {

    	$response = $this->response;
        $request = $this->request;

        $docs = AcDocumentos::find([//obtiene el arra de los documentos
            'conditions' => 'id_paciente = :idPaciente:',
            'bind' => [
                'idPaciente' => 1//valor pordefecto
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

