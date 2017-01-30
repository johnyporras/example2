<?php

class AfiliadosController extends \Phalcon\Mvc\Controller
{

	private $_mensajes = '';
    private $_data = '';

    public function searchAction()
    {
    	$response = $this->response;
    	$request = $this->request;

    	if ( $this->session->get("id") == null ) {
    		
    		$status = 500;
            $msnStatus = 'Error';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Usted aun no posee una sesion iniciada',
            ];

    	}else{

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

