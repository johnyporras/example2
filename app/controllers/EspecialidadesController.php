<?php

class EspecialidadesController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_listServ = [];
    private $_listEsp = [];
    private $_mensajes = '';
    private $_data = '';

    public function allAction()//metodo del controlador que retorna un array con todas las especialidades, requiere token de validacion...ruta de acceso '/especialidades-all' via post
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

                $especialidades = AcEspecialidadesExtranet::find();//obtiene todas las especialidades

                foreach ( $especialidades as $item ){

                    $this->_listEsp[] = $item;

                }

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = $this->_listEsp;
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
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function allEspcAndServAction()//metodo del controlador que ertorna un array con todos los revicio y espacialidades, requiere token de validacion...ruta de acceso /especialidades-and-serv-all via post
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

                $especialidades = AcEspecialidadesExtranet::find();//obtiene array con todas las especialidades
                $servicios = AcServiciosExtranet::find();//obtiene array con todos los servicios

                foreach ( $servicios as $item ){

                    $this->_listServ[] = $item;

                }

                foreach ( $especialidades as $item ){

                    $this->_listEsp[] = $item;

                }

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = ["esp" => $this->_listEsp, "serv" => $this->_listServ];//arra enviado a la app
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
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function listAction()//metodo del controlador que retorna un array con la lista de especialidades de acuerdo a la rama a travez de la variable 'acrDesc', no requiere token de validacion... ruta de acceso '/especialidades-list'
    {

        $response = $this->response;
        $request = $this->request;

        $ramo = AcRamo::findFirstByacrDesc($request->getPost('acrDesc'));

        $especialidades = AcEspecialidadesExtranet::find([
            'conditions' => 'rama = :acr_id:',
            'bind' => [
                'acr_id' => $ramo->acr_id
            ]
        ]);

        foreach ( $especialidades as $item ){

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

