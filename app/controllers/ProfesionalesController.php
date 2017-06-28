<?php

class ProfesionalesController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
	private $_mensajes = '';
    private $_data = '';
    private $_valor = '';

    public function listCiudadesAction()
    {

        $response = $this->response;
        $request = $this->request;

        $especialidad = AcEspecialidadesExtranet::findFirstById($request->getPost('idEsp'));

        $ciudades = AcProveedoresExtranet::find([
            'conditions' => 'estado_id = :estado: AND codigo_especialidad = :especialidad:',
            'group by' => 'ciudad',
            'bind' => [
                'estado' => $request->getPost('idEstado') ? $request->getPost('idEstado') : 0,
                'especialidad' => $especialidad->codigo_especialidad
            ]
        ]);

        foreach ($ciudades as $item){

            if ( $item->ciudad !== $this->_valor ) {

                 $this->_list[] = $item; 
             }

             $this->_valor = $item->ciudad;

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

    public function listProfAction()
    {

    	$response = $this->response;
    	$request = $this->request;

    	$prof = AcProveedoresExtranet::find([
            'conditions' => 'ciudad = :ciudad:',
            'bind' => [
                'ciudad' => $request->getPost('ciudad')
            ]
        ]);

        foreach ($prof as $item){

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

