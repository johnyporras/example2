<?php

class CitasController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listEspAction()
    {

        $response = $this->response;
        $request = $this->request;

        $lista = OperadorEspecialidad::find();
        foreach ($lista as $item)
        {
            $Auxarray["id"] =$item->id;
            $Auxarray["id"] =$item->Especialidad->nombre;
            $this->_list[] = $item;            
        }
        

        $status = 200;
        $msnStatus = 'OK';
        //$this->_data = $this->_list;
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
    
    
    public function listHoraAction()//metodo del controlador que no requiere token..retorna un array con citas..ruta de acceso '/citas-list' via post
    {
        
        $response = $this->response;
        $request = $this->request;
        
        $lista = BloqueHorario::find();
        foreach ($lista as $item )
        {
            
            $this->_list[] = $item;
            
        }
        
        
        $status = 200;
        $msnStatus = 'OK';
        //$this->_data = $this->_list;
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
    

    public function incluirAction()
    {
        $oCita = new Citas();
        
        $datos = JWT::decode($token, "Atiempo-api-rest", ['HS256']);
        $user = Users::findFirstById($datos->user->id); 
        $titular = AcAfiliados::findFirstById($user->detalles_usuario_id); 
        $oCita->id_operador_especialidad = $request->getPost('idesp');
        $oCita->id_afiliado =  $titular->id;
        $oCita->fecha = $request->getPost('fecha');
        $oCita->hora = $request->getPost('hora');  
        $oCita->save();
        
        
        $status = 200;
        $msnStatus = 'OK';
        //$this->_data = $this->_list;
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

    public function validarAction()
    {

        $response = $this->response;
        $request = $this->request;

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = $clave->clave;//se envia la clave generada para la cita
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

