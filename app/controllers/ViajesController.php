<?php

use Phalcon\Security\Random;

class ViajesController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_detalles_avi = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listAllAction()//metodo del controlador que retorna un array filtrado con los viajes del afiliado, requiere token de validacion...ruta de acceso '/viajes-list' via post
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

                $lista = Avi::find([//obtiene array filtrado del a busqueda
                    'conditions' => 'cedula_afiliado = :ced_afi:',
                    'bind' => [
                        'ced_afi' => $datos->titular->cedula
                    ]
                ]);

                foreach($lista as $item){

                    $destinos = AviDestino::find([//obtiene el detalle de los viajes
                        'conditions' => 'avi_id = :cod:',
                        'bind' => [
                            'cod' => $item->id,
                        ]
                    ]);

                    foreach($destinos as $destino){

                        $this->_detalles_avi[] = ['detalle' => $destino, 'pais' => $destino->Paises];

                    }

                    $this->_list[] = ['avi' => $item, 'detalleAvi' => $this->_detalles_avi];

                    $this->_detalles_avi = [];

                }

                $status = 200;
                $msnStatus = 'OK';
                //$this->_data = $this->_list;
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

    public function genViajeAction()//metodo del controlador que registra los viajes solicitados por el afiliados, requiere token de autenticacion...ruta de acceso '/generar-viaje' via post
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
                $edadAfiliado = date('Y-m-d') - $datos->titular->fecha_nacimiento;
                $coberMonto = 1;
                $objViajes = json_decode($request->getPost('viajes'));
                $observacines = $request->getPost('observ');
                $cronograma = $request->getPost('cronograma');

                $avi = new Avi();
                $avi->codigo_solicitud = 'av'.substr(uniqid(),7,13);
                $avi->cedula_afiliado = $datos->titular->cedula;
                $avi->codigo_contrato = $datos->titular->id_cuenta;//OJO
                $avi->cobertura_monto = $coberMonto;
                $avi->edad_afiliado = $edadAfiliado;
                $avi->nro_cronograma = $cronograma;
                $avi->observaciones = $observacines;
                $avi->creador = 1;
                $avi->save();

                foreach( $objViajes as $item ){

                    $aviDestino = new AviDestino();
                    $aviDestino->avi_id = $avi->id;
                    $aviDestino->pais_id= $item->codPais;
                    $aviDestino->fecha_desde = $item->desde;
                    $aviDestino->fecha_hasta = $item->hasta;
                    $aviDestino->save();

                }

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = substr(uniqid(),7,13);
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

