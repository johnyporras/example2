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

        $ramo = AcRamo::findFirstByAcrDesc($request->getPost('ramo'));

        $ciudades = AcProfesionales::find([
            'conditions' => 'acp_es_id = :estado: AND acp_acr_id = :ramo: AND acp_ace_id = :especialidad:',
            'group by' => 'acp_ciudad',
            'bind' => [
                'estado' => $request->getPost('idEstado') ? $request->getPost('idEstado') : 0,
                'ramo' => $ramo->acr_id,
                'especialidad' => $request->getPost('idEsp')
            ]
        ]);

        foreach ($ciudades as $item){

            if ( $item->acp_ciudad !== $this->_valor ) {

                 $this->_list[] = $item; 
             }

             $this->_valor = $item->acp_ciudad;

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

    	$prof = AcProfesionales::find([
            'conditions' => 'acp_ciudad = :ciudad:',
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

