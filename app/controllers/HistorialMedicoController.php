<?php

class HistorialMedicoController extends \Phalcon\Mvc\Controller
{

	private $_listHist = [];
	private $_listExam = [];
	private $_mensajes = '';
    private $_data = '';

    

    public function searchAction()//metodo del controlador que retorna un array filtrado a traves de la variable post 'id', no requiere token de validacion...ruta de acceso '/estado-search' via post
    {
        $response = $this->response;
        $request = $this->request;
        
        $historial = HistorialMedico::find([//obtiene el array filtrado
            'conditions' => 'id_afiliado = :value:',
            'bind' => [
                'value' => $request->get('idAfiliado')
            ]
        ]);
       
       //var_dump($res);
        foreach ( $historial as $item ){
            
            $this->_listHist[] = $item;
            
        }
        
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            "historial" => $this->_listHist
        ];//arra enviado a la app
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
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
    
    public function searchExamenesAction()//metodo del controlador que retorna un array filtrado a traves de la variable post 'id', no requiere token de validacion...ruta de acceso '/estado-search' via post
    {
       
        $response = $this->response;
        $request = $this->request;
        
        $historial = HistorialMedico::findFirst($request->get('idHistorial'));
        
        $examenes = $historial->HistorialExamenes;
        //var_dump($res);
        foreach ($examenes as $item ){
            
            $this->_listExam[] = $item;
            
        }
        
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            "examanes" => $this->_listExam
        ];//arra enviado a la app
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
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

