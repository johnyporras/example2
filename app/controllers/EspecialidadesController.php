<?php

class EspecialidadesController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_listServ = [];
    private $_listEsp = [];
    private $_mensajes = '';
    private $_data = '';

    public function allAction()
    {

        $response = $this->response;
        $request = $this->request;
        $token = $request->getPost('token');

        if( !isset($token) || empty($token) ){

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito',
                "msnToken" => false,//el token de autrización esta ausente
                "msnInvalid" => null
            ];

        }else{

            $datos = JWT::decode($token, "Atiempo-api-rest", ['HS256']);

            //comprobamos si existe el usuario
            $auth = Users::findFirst('user = "'.$datos->user->user.'" AND password = "'.$datos->user->password.'"');

            //si no existe
            if($auth->count() == 0)
            {
                //no es un token correcto
                //devolvemos un 401, Unauthorized
                $status = 200;
                $msnStatus = 'OK';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                    "msnHeaders" => true,
                    "msnInvalid" => true//las credenciales del token de autorizacion son invalidas
                ];
            }else{

                $especialidades = AcEspecialidadesExtranet::find();
                $servicios = AcServiciosExtranet::find();

                foreach ( $servicios as $item ){

                    $this->_listServ[] = $item;

                }

                foreach ( $especialidades as $item ){

                    $this->_listEsp[] = $item;

                }

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = ["esp" => $this->_listEsp, "serv" => $this->_listServ];
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

    public function listAction()
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

