<?php

class CitasVideoController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listEspAction()
    {
        //die("1111");
          $response = $this->response;
        $request = $this->request;

        $lista = OperadorEspecialidad::find();
        foreach ($lista as $item)
        {
            $Auxarray["id"] =$item->id;
            $Auxarray["nombre"] =$item->Especialidad->nombre;
            $Auxarray["horario"] =json_encode($item->Especialidad->horario);
            $this->_list[] = $Auxarray;            
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
    
    
    public function listCitasAction()
    {
        //die("1111");
        $response = $this->response;
        $request = $this->request;
        $token = $request->post("token");
        $datos = JWT::decode($token, "Atiempo-api-rest", ['HS256']);
        $user = Users::findById_afiliado($datos->user->id);
       // $codigo = "30000";
        $codigo = $user->detalles_usuario_id;
        
        $Citas = Citas::find([//obtiene el array filtrado
            'conditions' => 'id_afiliado = :value:',
            'bind' => [
                'value' =>$codigo
            ]
        ]);
        
        foreach ($Citas as $item)
        {
            $Auxarray["id"] =$item->id;
            $Auxarray["fecha"] =$item->fecha;
            $Auxarray["hora"] =$item->BloqueHorario->hora;
            $Auxarray["especialidad"] =$item->OperadorEspecialidad->Especialidad->nombre;
            $Auxarray["operador"] =$item->OperadorEspecialidad->Operador->nombre." ".$item->OperadorEspecialidad->Operador->apellido;
            $this->_list[] = $Auxarray;
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
    
    
    public function listCitasFechaAction()
    {
        //die("1111");
        $response = $this->response;
        $request = $this->request;
     
        // $codigo = "30000";
        $codigo = $fecha;
        
        $Citas = Citas::find([//obtiene el array filtrado
            'conditions' => 'fecha = :value:',
            'bind' => [
                'value' =>$fecha
            ]
        ]);
        
        foreach ($Citas as $item)
        {
            $Auxarray["id"] =$item->id;
            $Auxarray["fecha"] =$item->fecha;
            $Auxarray["hora"] =$item->BloqueHorario->hora;
            $Auxarray["especialidad"] =$item->OperadorEspecialidad->Especialidad->nombre;
            $Auxarray["operador"] =$item->OperadorEspecialidad->Operador->nombre." ".$item->OperadorEspecialidad->Operador->apellido;
            $this->_list[] = $Auxarray;
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
    

    public function incluirCitaAction()
    {
        $response = $this->response;
        $request = $this->request;
        $oCita = new Citas();
        
        $datos = JWT::decode($token, "Atiempo-api-rest", ['HS256']);
        $user = Users::findFirstById($datos->user->id); 
        $codigo=$user->detalles_usuario_id;
       // $codigo=30000;
        $titular = AcAfiliados::findFirstById($user->detalles_usuario_id); 
        $oCita->id_operador_especialidad = $request->getPost('idesp');
        $oCita->id_afiliado =  $titular->id;
        $oCita->fecha = $request->getPost('fecha');
        $oCita->id_bloque = $request->getPost('hora');
        $oCita->estatus =1;
        $oCita->save();
        
        
        $status = 200;
        $msnStatus = 'OK';
        //$this->_data = $this->_list;
        $this->_data = $this->_list;
        $this->_mensajes = [
            "msnConsult" => 'cita incluida con exito',
        ];
        
        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();
        
        $this->view->disable();
    
    
    }

    public function estaDisponible($id,$fecha,$hora)
    {

        $response = $this->response;
        $request = $this->request;
        
       $res =Citas::find(
            [
                "name = :id_operador_especialidad: AND id_bloque = :hora: AND fecha = :fecha:",
                "bind" => [
                    "id_operador_especialidad" => $id,
                    "hora" => $hora,
                    "fecha" => $fecha
                ]
            ] 
            );
               
       if($res->count()>0)
       {
           return true;
       }
          
       
    }


   

}

