<?php

class CitasController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listEspAction()//metodo del controlador que no requiere token..retorna un array con citas..ruta de acceso '/citas-list' via post
    {

        $response = $this->response;
        $request = $this->request;

        $lista = Especialidad::find();
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

    public function incluirAction()//metodo del controlador que retorna un array de clinicas, requiere de token de validacion... ruta de acceso '/list-clinicas' via post
    {
        $esp = new especialidad();
        
        $user->name = $request->getPost('name');
        $user->email = $request->getPost('email');
        $user->password = $this->security->hash($request->getPost('password'));
        $user->department = 'Sistemas';
        $user->type = 2;
        $user->user = $request->getPost('user');
        $user->active = 'N';
        $user->proveedor = 1;
        
        if (!$user->save())
        {
            
            $transaction->rollback("Problemas durante el registro de usuario, por favor intentelo mas tarde o comuniquese con un administrador del sistema");
            
        }
    }

    public function validarAction()//metodo del controlador que genera la clave y crea el registro para las citas, requiere token de autorizacion...ruta de acceso '/generar-claves' via post
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

