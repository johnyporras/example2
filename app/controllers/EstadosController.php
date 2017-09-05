<?php

class EstadosController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
	private $_mensajes = '';
    private $_data = '';

    public function allAction()//metodo del controlador que retorna un array con todos los estados, no requiere token de validacion... ruta de acceso '/estados-list' via get
    {

    	$response = $this->response;

        $listEstados = AcEstados::find();//retorna array con los estados

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

    public function searchAction()//metodo del controlador que retorna un array filtrado a traves de la variable post 'id', no requiere token de validacion...ruta de acceso '/estado-search' via post
    {

    	$response = $this->response;
    	$request = $this->request;

        $estado = AcEstados::findFirstByEsId( $request->getPost('id') );//obtiene el array filtrado

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

    public function searchCiudadesAction()//metodo del controlador que retorna un array filtrado a traves de la variable post 'id', no requiere token de validacion...ruta de acceso '/ciudades-list' via post
    {

    	$response = $this->response;
    	$request = $this->request;

        $ciudades = AcProveedoresExtranet::find([//obtiene el array filtrado
            'conditions' => 'estado_id = :value:',
            'bind' => [
                'value' => $request->getPost('idEstado')
            ]
        ]);

        if ( $ciudades ) {

        	$this->_data = $ciudades;

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

