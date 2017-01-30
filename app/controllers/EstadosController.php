<?php

class EstadosController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
	private $_mensajes = '';
    private $_data = '';

    public function allAction()
    {

    	$response = $this->response;

        $listEstados = AcEstados::find();

        foreach ( $listEstados as $item ){

            $this->_list[] = $item;

        }

        $response->setJsonContent([
            "status" => 200,
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito',
            ],
            "data" => $this->_list,
        ]);
        $response->setStatusCode(200, 'OK');
        $response->send();

        $this->view->disable();

    }

    public function searchAction()
    {

    	$response = $this->response;
    	$request = $this->request;

        $estado = AcEstados::findFirstByEsId( $request->getPost('id') );

        if ( $estado ) {
        	
        	$this->_data = $estado;

        	$msnConsult = 'Consulta relizada con exito';

        }else{

        	$this->_data = null;

        	$msnConsult = 'Ningun resultado obtenido';

        }

        $response->setJsonContent([
            "status" => 200,
            $this->_mensajes = [
                "msnConsult" => $msnConsult,
            ],
            "data" => $this->_data,
        ]);
        $response->setStatusCode(200, 'OK');
        $response->send();

        $this->view->disable();

    }

}

