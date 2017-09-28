<?php

class ProcedimientosMedicosController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';

    public function allAction()//metodo del controlador que retorna un array con todos los procedimientos medicos, no requiere token de validacion... ruta de acceso '/procedimientos-medicos-all' via get
    {

        $response = $this->response;
        $request = $this->request;

        $procMedicos = AcProcedimientosMedicos::find();//obtien el array con todos los procedimientos medicos

        foreach ( $procMedicos as $item ){

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

    public function listAction()//metodo del controlador que rretorna un array filtrado con las variables pos 'serv' y 'espec' de los procedimientos medicos, requiere token de validacion...ruta de acceso '/procedimientos-medicos-list' via post
    {

        $response = $this->response;
        $request = $this->request;
        $token = $request->getPost('token');//obtiene el token de validacion via post y se asigna a una variable 'token'

        if( !isset($token) || empty($token) ){//se verifica si no existe y si esta vacio

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito',
                "msnToken" => false,//el token de autrización esta ausente
                "msnInvalid" => null
            ];

        }else{//en caso de existir y no estar vacio

            $datos = JWT::decode($token, "Atiempo-api-rest", ['HS256']);//desencripta el token y se asigna a una variable 'datos'

            //comprobamos si existe el usuario mediante los datos obtenidos por el token
            $auth = Users::findFirst('user = "'.$datos->user->user.'" AND password = "'.$datos->user->password.'"');

            //si no existe
            if($auth->count() == 0)
            {
                //no es un token correcto
                $status = 200;
                $msnStatus = 'OK';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                    "msnHeaders" => true,
                    "msnInvalid" => true//las credenciales del token de autorizacion son invalidas
                ];
            }else{

                $procMedicos = AcProcedimientosMedicos::find([//obtiene el array filtrado con los procedimientos medicos
                    'conditions' => 'codigo_servicio = :serv: AND codigo_especialidad = :espec:',
                    'bind' => [
                        'serv' => $request->getPost('serv'),//variable post usada para filtrar la busqueda
                        'espec' => $request->getPost('espec')//variable post usada para filtrar la busqueda
                    ]
                ]);

                foreach ( $procMedicos as $item ){

                    $this->_list[] = $item;

                }

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = $this->_list;
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                    "msnHeaders" => true,//el header de autrización esta ausente
                    "msnInvalid" => false
                ];

            }

        }

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function montoAction()//metodo del controlador usado para obtener un objeto con el monto del procedimiento medico, requiere token de validacion...ruta de acceso '/serv-monto' via post
    {

        $response = $this->response;
        $request = $this->request;
        $token = $request->getPost('token');//obtiene el token de validacion via post y se asigna a una variable 'token'

        if( !isset($token) || empty($token) ){//se verifica si no existe y si esta vacio

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito',
                "msnToken" => false,//el token de autrización esta ausente
                "msnInvalid" => null
            ];

        }else{//en caso de existir y no estar vacio

            $datos = JWT::decode($token, "Atiempo-api-rest", ['HS256']);//desencripta el token y se asigna a una variable 'datos'

            //comprobamos si existe el usuario mediante los datos obtenidos por el token
            $auth = Users::findFirst('user = "'.$datos->user->user.'" AND password = "'.$datos->user->password.'"');

            //si no existe
            if($auth->count() == 0)
            {
                //no es un token correcto
                $status = 200;
                $msnStatus = 'OK';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                    "msnHeaders" => true,
                    "msnInvalid" => true//las credenciales del token de autorizacion son invalidas
                ];
            }else{

                $montoBaremos = AcBaremos::findFirst([//obtiene el objeto de la busqueda
                    'conditions' => 'id_procedimiento = :idProc: AND id_proveedor = :idProv:',
                    'bind' => [
                        'idProc' => $request->getPost('idProc'),//variables post usadas en la busqueda
                        'idProv' => $request->getPost('idProv')//variables post usadas en la busqueda
                    ]
                ]);

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = $montoBaremos ? $montoBaremos->monto : 555;
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                    "msnHeaders" => true,//el header de autrización esta ausente
                    "msnInvalid" => false
                ];

            }

        }

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }
    
    
      

}

