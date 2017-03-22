<?php

use Phalcon\Security\Random;

class ViajesController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listAllAction()
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

                $lista = Avi::find([
                    'conditions' => 'cedula_afiliado = :ced_afi: AND codigo_contrato = :cod_contra:',
                    'bind' => [
                        'ced_afi' => $datos->contrato->cedula_afiliado,
                        'cod_contra' => $datos->contrato->codigo_contrato
                    ]
                ]);

                foreach($lista as $item){

                    $destinos = AviDestino::find([
                        'conditions' => 'codigo_solicitud_avi = :cod:',
                        'bind' => [
                            'cod' => $item->id,
                        ]
                    ]);

                    $this->_list[] = ['avi' => $item, 'detalleAvi' => $destinos];

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
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function genViajeAction()
    {
        $random = new Random();
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

                $objAfiliado = json_decode($request->getPost('afiliado'));
                $objcontrato = json_decode($request->getPost('contrato'));
                $edadAfiliado = date('Y-m-d') - $objAfiliado->fecha_nacimiento;
                $coberMonto = 1;
                $codSolicitud = $random->number(9999999);
                $objViajes = json_decode($request->getPost('viajes'));
                $observacines = $request->getPost('observ');
                $cronograma = $request->getPost('cronograma');

                $avi = new Avi();
                $avi->codigo_solicitud = $codSolicitud;
                $avi->cedula_afiliado = $objcontrato->cedula_afiliado;
                $avi->codigo_contrato = $objcontrato->codigo_contrato;
                $avi->cobertura_monto = $coberMonto;
                $avi->edad_afiliado = $edadAfiliado;
                $avi->nro_cronograma = $cronograma;
                $avi->observaciones = $observacines;
                $avi->creador = 1;
                $avi->save();

                foreach( $objViajes as $item ){

                    $aviDestino = new AviDestino();
                    $aviDestino->codigo_solicitud_avi = $avi->id;
                    $aviDestino->pais_destino = $item->pais;
                    $aviDestino->fecha_desde = $item->desde;
                    $aviDestino->fecha_hasta = $item->hasta;
                    $aviDestino->save();

                }

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                    "msnHeaders" => true,
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

}

