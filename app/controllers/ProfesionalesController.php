<?php

class ProfesionalesController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
	private $_mensajes = '';
    private $_data = '';
    private $_valor = '';

    public function listCiudadesAction()//metodo del controlador que un array filtrado con las especialadades y un objeto con datos del proveedor, no requiere token de validacion...ruta de acceso '/ciudades-list' via post
    {

        $response = $this->response;
        $request = $this->request;

        $especialidad = AcEspecialidadesExtranet::findFirstById($request->getPost('idEsp'));//obtiene el objeto con los datos del proveedor con la varia pots 'idEsp'

        $ciudades = AcProveedoresExtranet::find([//obtiene array filtrado con los proveedores
            'conditions' => 'estado_id = :estado: AND codigo_especialidad = :especialidad:',
            'group by' => 'ciudad',
            'bind' => [
                'estado' => $request->getPost('idEstado') ? $request->getPost('idEstado') : 0,//variables post usadas en el filtrado del array
                'especialidad' => $especialidad->codigo_especialidad//variables post usadas en el filtrado del array
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

    public function listProfAction()//metodo del controlador usado para el filtrado de los proveedores, no requiere token de validacion...ruta de acceso '/profesionales-list' via post
    {

    	$response = $this->response;
    	$request = $this->request;

    	$prof = AcProveedoresExtranet::find([//obtiene el array filtrado con los proveedores
            'conditions' => 'ciudad = :ciudad:',
            'bind' => [
                'ciudad' => $request->getPost('ciudad')//variable post usada para el filtrado del array
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

