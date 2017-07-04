<?php

class AseguradorasController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
	private $_mensajes = '';
    private $_data = '';

    public function allAction()//metodo del controlador que no requiere token y retorna un array con todas las aseguradoras
    {

    	$response = $this->response;
    	$request = $this->request;

		$aseguradoras = AcAseguradora::find();//obtiene todas las aseguradoras

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

    public function searchAction(){//metodo del controlador que no requiere token y retorna un objeto con los datos de una aseguradora

    	$response = $this->response;
    	$request = $this->request;

		$aseguradora = AcAseguradora::findFirstById( $request->getPost('id') );//obtiene la aseguradora a traves de la variable 'id' enviada por el metodo post

		if ( $aseguradora ) {//si la busqueda retorna un objeto, se envia un mensaje con el valor generado por la busqueda

			$status = 200;
			$msnStatus = 'OK';
			$this->_data = $aseguradora;//valor de la busqueda
			$this->_mensajes = [
					"msnConsult" => 'Consulta relizada con exito',//mensaje enviado
			];

		}else{//en caso de no retornar un objeto, envia un mensaje y valor 'null'

			$status = 200;
			$msnStatus = 'OK';
			$this->_data = null;//valor enviado
			$this->_mensajes = [
					"msnConsult" => 'Ningun resultado obtenido',//mensaje enviado
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

