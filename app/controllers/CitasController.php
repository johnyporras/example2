<?php

class CitasController extends \Phalcon\Mvc\Controller
{

	private $_list = [];
    private $_mensajes = '';
    private $_data = '';
    private $_detailClaves = [];

    public function listAllAction()//metodo del controlador que no requiere token..retorna un array con citas..ruta de acceso '/citas-list' via post
    {

        $response = $this->response;
        $request = $this->request;

        $lista = AcClaves::find([//obtiene array de citas por medio de la variable post 'cedula'
            'conditions' => 'cedula_afiliado = :cedula:',
            'bind' => [
                'cedula' => $request->getPost('cedula')
            ]
        ]);

        foreach ( $lista as $item ){//recorre el array de las citas encontradas

            foreach (AcClavesDetalle::find('id_clave = '.$item->id) as $itemDetail) {//obtiene y recorre el array de los detalles de la cita
                
                $this->_detailClaves[] = [//creacion del array que contiene el detalle de la cita

                    'tipoServ' => AcServiciosExtranet::findFirstByCodigoServicio($itemDetail->codigo_servicio),//obtiene el detalle de la cita

                    'proMedico' => AcProcedimientosMedicos::findFirst([//obtiene el procedimiento de la cita
                        'conditions' => 'codigo_especialidad = :idCodEspc: AND codigo_servicio = :idCodServ:',
                        'bind' => [
                            'idCodServ' => $itemDetail->codigo_servicio,
                            'idCodEspc' => $itemDetail->codigo_especialidad
                        ]
                    ]),

                    'proveedor' => $itemDetail->AcProveedoresExtranet,

                    'especialidad' => $itemDetail->AcEspecialidadesExtranet

                ];

            }

            $this->_list[] = [//creacion del array de la cita

                'nombre' => '',
                'fecha' => $item->fecha_cita,
                'clave' => $item->clave,
                'codigoProve' => $item->codigo_proveedor_creador ? $item->codigo_proveedor_creador : 'no',
                'detallesClave' => $this->_detailClaves,

            ];

            $this->_detailClaves = [];

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

    public function buscarAction()//metodo del controlador que retorna un array de clinicas, requiere de token de validacion... ruta de acceso '/list-clinicas' via post
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

                $busqueda = AcProveedoresExtranet::find([//obtiene el array de las clinicas mediante la variable 'val' obtenida via post
                    'conditions' => 'nombre LIKE :value:',
                    'bind' => [
                        'value' => '%'.strtoupper($request->getPost('val')).'%'
                    ]
                ]);

                foreach ( $busqueda as $item ){

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
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();

        $this->view->disable();

    }

    public function genClavAction()//metodo del controlador que genera la clave y crea el registro para las citas, requiere token de autorizacion...ruta de acceso '/generar-claves' via post
    {

        $response = $this->response;
        $request = $this->request;
        $random = new \Phalcon\Security\Random();
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

                $objDatos =  json_decode( $request->getPost('obj') );//objeto enviado via post que contiene los datos para la creacion de las citas

                $clave = new AcClaves();
                $clave->clave = AcClaves::claveRandom();
                $clave->cedula_afiliado = $objDatos->cedula_afiliado;
                $clave->codigo_contrato = $datos->titular->id_cuenta;
                $clave->fecha_cita = $objDatos->fecha_cita;
                $clave->motivo = $objDatos->motivo;
                $clave->observaciones = $objDatos->observaciones;
                $clave->costo_total = $objDatos->montoTotal;
                $clave->codigo_proveedor_creador = 0;
                $clave->correo = $objDatos->email;
                $clave->examen = null;
                $clave->estatus_clave = 1;
                $clave->creador = $datos->user->id;
                $clave->telefono = $objDatos->telefono;
                $clave->rechazo = null;
                $clave->tipo_afiliado = $objDatos->tipoAfiliado;
                //$clave->cantidad_servicios = $objDatos->cantServ;
                $clave->cantidad_servicios = 1;
                $clave->hora_autorizado = null;
                $clave->id_factura = null;
                $clave->save();

                //aqui se mandan los detalles de los servicios que tienen que ver con la espacialidad, de igual forma estos valores los puedes chekr una vez se guarden

                foreach ($objDatos->detailClaveServ as $item ) {

                    $claveDetalle = new AcClavesDetalle();
                    $claveDetalle->id_clave = $clave->id;
                    $claveDetalle->codigo_servicio = $item->tipoServ->codigo_servicio;
                    $claveDetalle->codigo_especialidad = $objDatos->espec;
                    $claveDetalle->id_procedimiento = $item->proMed->id;
                    $claveDetalle->codigo_proveedor = $item->prov->codigo_proveedor;
                    $claveDetalle->costo = $item->monto;
                    $claveDetalle->detalle = $objDatos->detailServ;
                    $claveDetalle->estatus = 1;
                    $claveDetalle->save();

                }

                foreach ($objDatos->detailClaveServ as $item ) {

                    $claveDetalleProv = new AcClavedetalleprov();
                    $claveDetalleProv->id_clave = $clave->id;
                    $claveDetalleProv->id_proveedor = $item->prov->id;
                    $claveDetalleProv->aceptado = 0;
                    $claveDetalleProv->observacion = null;
                    $claveDetalleProv->fechacita = null;
                    $claveDetalleProv->horacita = null;
                    $claveDetalleProv->preferido = $item->pre == true ? 1 : 0;
                    $claveDetalleProv->save();

                }

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = $clave->clave;//se envia la clave generada para la cita
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


    public function allAction()//metodo del controlador que retorna un array con todas las citas, requiere token de autorizacion...ruta de acceso no definida, actualmente no se usa
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


                $lista = AcClaves::find();//obtiene array de todas citas

                foreach ( $lista as $item ){//recorre el array de las citas encontradas

                    foreach (AcClavesDetalle::find('id_clave = '.$item->id) as $itemDetail) {//obtiene y recorre el array de los detalles de la cita

                        $this->_detailClaves[] = [//creacion del array que contiene el detalle de la cita

                            'tipoServ' => AcServiciosExtranet::findFirstByCodigoServicio($itemDetail->codigo_servicio),//obtiene el detalle de la cita

                            'proMedico' => AcProcedimientosMedicos::findFirst([//obtiene el procedimiento de la cita
                                'conditions' => 'codigo_especialidad = :idCodEspc: AND codigo_servicio = :idCodServ:',
                                'bind' => [
                                    'idCodServ' => $itemDetail->codigo_servicio,
                                    'idCodEspc' => $itemDetail->codigo_especialidad
                                ]
                            ]),

                            'proveedor' => $itemDetail->AcProveedoresExtranet,

                            'especialidad' => $itemDetail->AcEspecialidadesExtranet

                        ];

                    }

                    $this->_list[] = [//creacion del array de la cita

                        'nombre' => '',
                        'fecha' => $item->fecha_cita,
                        'clave' => $item->clave,
                        'codigoProve' => $item->codigo_proveedor_creador ? $item->codigo_proveedor_creador : 'no',
                        'detallesClave' => $this->_detailClaves,

                    ];

                    $this->_detailClaves = [];

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


}

