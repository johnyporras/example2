<?php

class ProcedimientosMedicosController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';

    public function allAction()
    {

        $response = $this->response;
        $request = $this->request;

        $procMedicos = AcProcedimientosMedicos::find();

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

    public function listAction()
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

                $procMedicos = AcProcedimientosMedicos::find([
                    'conditions' => 'codigo_servicio = :serv: AND codigo_especialidad = :espec:',
                    'bind' => [
                        'serv' => $request->getPost('serv'),
                        'espec' => $request->getPost('espec')
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

    public function montoAction()
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

                $montoBaremos = AcBaremos::findFirst([
                    'conditions' => 'id_procedimiento = :idProc: AND id_proveedor = :idProv:',
                    'bind' => [
                        'idProc' => $request->getPost('idProc'),
                        'idProv' => $request->getPost('idProv')
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

