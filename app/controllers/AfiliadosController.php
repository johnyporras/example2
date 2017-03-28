<?php

class AfiliadosController extends \Phalcon\Mvc\Controller
{

	private $_mensajes = '';
    private $_data = '';

    public function searchAction()
    {
    	$response = $this->response;
    	$request = $this->request;

		$afiliado = AcAfiliados::findFirstByCedula( $request->getPost('cedula') );

		if ( $afiliado ) {

			$status = 200;
			$msnStatus = 'OK';
			$this->_data = $afiliado;
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

    }

}

