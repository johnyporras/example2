<?php

class AseguradorasController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
	private $_mensajes = '';
    private $_data = '';

    public function allAction()
    {

    	$response = $this->response;
    	$request = $this->request;

		$aseguradoras = AcAseguradora::find();

		foreach ( $aseguradoras as $item ){

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

    public function searchAction(){

    	$response = $this->response;
    	$request = $this->request;

		$aseguradora = AcAseguradora::findFirstById( $request->getPost('id') );

		if ( $aseguradora ) {

			$status = 200;
			$msnStatus = 'OK';
			$this->_data = $aseguradora;
			$this->_mensajes = [
					"msnConsult" => 'Consulta relizada con exito',
			];

		}else{

			$status = 200;
			$msnStatus = 'OK';
			$this->_data = null;
			$this->_mensajes = [
					"msnConsult" => 'Ningun resultado obtenido',
			];

		}

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

