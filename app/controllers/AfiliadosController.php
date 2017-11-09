<?php

class AfiliadosController extends \Phalcon\Mvc\Controller
{

	private $_mensajes = '';
    private $_data = '';

    public function searchAction()//metodo buscar no requiere token..ruta de acceso '/afiliado-search' via post
    {
    	$response = $this->response;
    	$request = $this->request;

		$afiliado = AcAfiliados::findFirstByCedula( $request->getPost('cedula') );//recibe la variable 'cedula' por post

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
				$this->view->disable();
    }

}
