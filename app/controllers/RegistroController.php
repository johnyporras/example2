<?php
//use namespace as alias;
class RegistroController extends \Phalcon\Mvc\Controller
{

	private $_listHist = [];
	private $_listExam = [];
	private $_mensajes = '';
    private $_data = '';

    

    public function checkTarjetaAction()
    {
        $response = $this->response;
        $request = $this->request;
        
        //var_dump($request->get('codTarjeta'));die();
        
        if($request->get('codTarjeta')!="")
        {    
            $tarjeta = hash('sha256',sha1(md5($request->get('codTarjeta'))));
           // die($tarjeta);
            $rsTarjeta = Tarjetas::findFirst([//obtiene el array filtrado
                'conditions' => 'codigo_tarjeta = :value:',
                'bind' => [
                    'value' =>$tarjeta
                ]
            ]);
           // var_dump($rsTarjeta);die();
            
            if($rsTarjeta!==false)
            {
                if($rsTarjeta->activada=="N")
                {
                    $rsCuenta = AcCuenta::findFirst([//obtiene el array filtrado
                        'conditions' => 'codigo_cuenta = :value:',
                        'bind' => [
                            'value' =>$request->get('codTarjeta')
                        ]
                    ]);
                    
                    if($rsCuenta!==false)
                    {
                        if ($rsCuenta->estatus == 5 ) {
                            // Verifico que tenga algun afiliado
                            if ($rsCuenta->AcAfiliados !== false) {
                                
                              //  var_dump($rsCuenta->AcAfiliados->id);die();
                                // Elimino usuario si tiene un usuario generado
                                $user = Users::findFirst([//obtiene el array filtrado
                                    'conditions' => 'detalles_usuario_id = :value:',
                                    'bind' => [
                                        'value' =>$rsCuenta->AcAfiliados->id
                                    ]
                                ]);
                                // valido si hay coincidencia
                                if ($user != null) {
                                    $user->delete();
                                }
                                // Elimino el afiliado
                                $rsCuenta->AcAfiliados->delete();
                            }
                            // Elimino la cuenta y planes asociados
                            if($rsCuenta->AcCuentaplan!==false)
                            {
                                $rsCuenta->AcCuentaplan->delete();
                            }
                            
                            $rsCuenta->delete();
                            // Guardo la session codigo
                          
                            
                            // Guardo el valor del formulario para comparar
                            $code = substr($request->get('codTarjeta'), 2, 3);
                            // tipo de plan dependiendo de codigo
                            $plan = substr($request->get('codTarjeta'), 0, 2);
                            
                            // Selecciono producto dependiendo del codigo
                            if ($plan == 90 || $plan == 40) {
                                // Producto a-card / a-member
                                $tplan = ($plan == 90)?'A-CARD':'A-MEMBER';
                            } else {
                                // producto a-doctor
                                $tplan = 'A-DOCTOR';
                            }
                            
                            //realizo un filtro para buscar en la tabla terminos
                            $terminos = Terminos::findFirst([//obtiene el array filtrado
                                'conditions' => 'codigo = :value:',
                                'bind' => [
                                    'value' =>$code
                                ]
                            ]);
                            
                            $mensaje="tarjeta valida";
                            $arrDatos["terminos"]=$terminos;
                            $arrDatos["plan"]=$tplan;
                            
                          /*  Session::set('terminos', [
                                'code' => $terminos->codigo,
                                'terminos' => $terminos->terminos]);
                            //session con valor del plan
                            Session::set('plan', $tplan);*/
                            
                          }
                            
                          if ( $rsCuenta->estatus == 2 ) {
                                $mensaje="tarjeta valida";
                                $arrDatos="";
                                //$arrDatos["terminos"]=$terminos;
                               // $arrDatos["tplan"]=$tplan;
                                // retorno respuesta redirect
                                //return response()->json(['id' => $cuenta->afiliado->id]);
                            }
                            
                            // retorno respuesta
                            //return response()->json(['success' => 'Tarjeta Valida']);
                        
                    }
                    else
                    {
                        
                    //    die("aqui");
                        $code = substr($request->get('codTarjeta'), 2, 3);
                        // tipo de plan dependiendo de codigo
                        $plan = substr($request->get('codTarjeta'), 0, 2);
                        
                        // Selecciono producto dependiendo del codigo
                        if ($plan == 90 || $plan == 40) {
                            // Producto a-card / a-member
                            $tplan = ($plan == 90)?'A-CARD':'A-MEMBER';
                        } else {
                            // producto a-doctor
                            $tplan = 'A-DOCTOR';
                        }
                        
                        //realizo un filtro para buscar en la tabla terminos
                        $terminos = Terminos::findFirst([//obtiene el array filtrado
                            'conditions' => 'codigo = :value:',
                            'bind' => [
                                'value' =>$code
                            ]
                        ]);
                        
                        $mensaje="Tarjeta valida";
                        $arrDatos["terminos"]=$terminos;
                        $arrDatos["plan"]=$tplan;
                        
                    }
                    
                    
                }
                else
                {
                    $mensaje="tarjeta activada";
                    $arrDatos="";
                }
            }
            else
            {
                $mensaje="tarjeta no encontrada";
                $arrDatos="";
            }
        }
        else
        {
            $mensaje="el codigo de la tarjeta es requerido";
            $arrDatos="";
        }
        
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            $arrDatos
        ];//arra enviado a la app
        
        $this->_mensajes = [
            "msnConsult" => $mensaje,
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
    
    
    public function checkTerminosAction()
    {
        
        $response = $this->response;
        $request = $this->request;
        // Envio codigo de tarjeta seleccionada
           // $codigo = chunk_split(Session::get('codigo'),4);
            // Retorno los terminos..
            //return response()->json(['codigo' => $codigo, 'plan' => Session::get('plan')]);  
            
        $mensaje="operacion realizada con exito";
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
           ""
            
            
        ];//arra enviado a la app
        
        $this->_mensajes = [
            "msnConsult" => $mensaje,
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
    
    
    
    public function cambiarEstatusCuentaAction()
    {
        
        $response = $this->response;
        $request = $this->request;
        if($request->get('cuenta')!="" && $request->get('oper')!="")
        {
            $oCuenta = AcCuenta::findFirstById($request->get('cuenta'));
            $idAfiliado =$oCuenta->AcAfiliado->id;
            
            $oUsuario = Users::findFirst([//obtiene el array filtrado
                'conditions' => 'detalles_usuario_id = :value:',
                'bind' => [
                    'value' =>$idAfiliado
                ]
            ]);
            
            
            if($request->get('oper')=='desactivar')
            {
                $oCuenta->estatus=0;
                $oUsuario->active=false;
            }
            elseif($request->get('oper')=='activar')
            {
                $oCuenta->estatus=1;
                $oUsuario->active=true;
            }   
        }
        
        if($oCuenta->save() && $oUsuario->save())
        {
            $mensaje="operacion realizada con exito";
            $status = 200;
        }
        else
        {
            $mensaje="no se realiz� la operaci�n";
            $status = 400;
        }        
        $msnStatus = 'OK';
        $this->_data = [
            ""
        ];//arra enviado a la app
        
        $this->_mensajes = [
            "msnConsult" => $mensaje,
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
    
    
    public function crearCuentaAction()
    {
        
        $response = $this->response;
        $request = $this->request;
        $datos=array();
        if ($request->get('codigo')!="")
        {
                $tarjeta = hash('sha256',sha1(md5($request->get('codigo'))));
                // die($tarjeta);
                $rsTarjeta = Tarjetas::findFirst([//obtiene el array filtrado
                    'conditions' => 'codigo_tarjeta = :value:',
                    'bind' => [
                        'value' =>$tarjeta
                    ]
                ]);
                // var_dump($rsTarjeta);die();
                
                if($rsTarjeta!==false)
                {
                    
                  
                // 4 sera el producto a-member y el 9 sera el producto a-card
                    $code = substr($request->get('codigo'), 0, 2);
                    // Selecciono producto dependiendo del codigo
                    if ($code == 90 || $code == 40) {
                        // Producto a-card / a-member
                        $producto = ($code == 90)?1:3;
                    } else {
                        // producto a-doctor
                        $producto = 2;
                    }        
                    try
                    {
                        $oCuenta = new AcCuenta();
                        $oCuenta->codigo_cuenta=$request->get('codigo');
                        $oCuenta->fecha= date("Y-m-d");
                        $oCuenta->estatus= 5;
                        $oCuenta->id_producto= $producto;
                        //$oCuenta->producto= 5;
                        $oCuenta->acepto_terminos=date("Y-m-d");
                        
                        
                        if($oCuenta->save())
                        {
                            $oCuentaPlan = new AcCuentaPlan();
                            $oCuentaPlan->id_cuenta=$oCuenta->id;
                            $oCuentaPlan->id_plan=substr($request->get('codigo'), 0, 2);
                            $oCuentaPlan->save();
                            
                            if($request->get('plan')==8)
                            {
                                
                                $oMascota=new Mascota();
                                $oMascota->cuenta_id=$oCuenta->id;
                                $oMascota->tamano_id=$request->get("tamano");
                                $oMascota->nombre=$request->get("nombre");
                                $oMascota->raza=$request->get("raza");
                                $oMascota->color_pelage=$request->get("color");
                                $oMascota->edad=$request->get("edad");
                                $oMascota->fecha=$request->get("fmascota");
                                $oMascota->tipo=$request->get("tipo");
                                $oMascota->save();  
                            }
                            
                            $datos["idcuenta"]=$oCuenta->id;
                            $mensaje="operacion realizada con exito";
                        }
                        else
                        {
                            $mensaje = '¡Ocurrio un error al generar cuenta!';
                            //var_dump($oCuenta->getMessages());die();
                        }
                    }
                    catch(QueryException $e)
                    {
                        $mensaje = '¡Ocurrio un error al generar cuenta!';
                    }    
            }
            else
            {
                $mensaje = 'Tarjeta invalida';
            }
        }
        
        
        
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            $datos
        ];//arra enviado a la app
        
        $this->_mensajes = [
            "msnConsult" => $mensaje,
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
    
    public function crearAfiliado()
    {
        
        $response = $this->response;
        $request = $this->request;
        
        if ($request->get('cuenta')!="")
        {
            
            $datos="";
           
            $emailAf = AcAfiliado::findFirst([//obtiene el array filtrado
                'conditions' => 'email = :value:',
                'bind' => [
                    'value' =>$request->get("correo")
                ]
            ]);
            
            $emailUser = User::findFirst([//obtiene el array filtrado
                'conditions' => 'email = :value:',
                'bind' => [
                    'value' =>$request->get("correo")
                ]
            ]);
            
            
            $cedulaAf = AcAfiliado::findFirst([//obtiene el array filtrado
                'conditions' => 'cedula = :value:',
                'bind' => [
                    'value' =>$request->get("cedula")
                ]
            ]);
            
            $embarazo = $request->get("cedula");
            
            if ($emailAf != false || $emailUser != false)
            {
                $mensaje = 'El Correo que ingreso ya esta en uso';
            }
            elseif($cedulaAf != false)
            {
                $mensaje = 'La cédula que ingreso ya existe en el sistema';
            }
            else
            {
                $oCuenta = AcCuenta::findFirstById($request->get('cuenta'));
                if($oCuenta!==false)
                {
                    try
                    {
                        $oAfiliado= new AcAfiliado();
                        $oAfiliado->cedula = $request->get('cedula');
                        $oAfiliado->nombre = $request->get('nombre');
                        $oAfiliado->apellido = $request->get('apellido');
                        $oAfiliado->fecha_nacimiento = $request->get('nacimiento');
                        $oAfiliado->email = $request->get('email');
                        $oAfiliado->sexo = $request->get('sexo');
                        $oAfiliado->telefono = $request->get('telefono');
                        $oAfiliado->id_cuenta = $request->get('cuenta');
                        $oAfiliado->id_estado = $request->get('estado');
                        $oAfiliado->ciudad = $request->get('ciudad');
                        $oAfiliado->embarazada = $request->get('embarazo');
                        $oAfiliado->tiempo_gestacion = $request->get('semanas');
                        $oAfiliado->save();
                        $datos["afiliado"] =$oAfiliado->id;
                        $mensaje="La operacion se realiz� conexito";
                    }
                    catch(QueryException $e)
                    {
                        $mensaje='¡Ocurrio un error al crear el afiliado!';
                    }
                }
                else
                {
                    $mensaje='No existe la cuenta';
                }
        
           }
        
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            $datos
        ];//arra enviado a la app
        
        $this->_mensajes = [
            "msnConsult" => $mensaje,
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
 
    
    
    public function crearUsuario()
    {
        $response = $this->response;
        $request = $this->request;
        
        if ($request->get('cuenta')!="" && $request->get('afiliado')!="")
        {
            
        
       $oAfiliado = AcAfiliado::findFirstById($request->get('afiliado'));
       $oCuenta = AcCuenta::findFirstById($request->get('cuenta'));
 
       $user = User::findFirst([//obtiene el array filtrado
           'conditions' => 'user = :value:',
           'bind' => [
               'value' =>$oAfiliado->email
           ]
       ]);
       
       
       
       
        // Selecciono tipo de usuario dependiento del producto de la cuenta
       $typeUser = ($oCuenta->id_producto == 1)?5:8;
        
        if($user == false)
        {
            
            $name = $oAfiliado->nombre.' '.$oAfiliado->apellido;
            
            try{
                //Genero el usuario
                $oUser= User();
                $oUser->name=$name;
                $oUser->email=$oAfiliado->email;
                $oUser->user=$oAfiliado->email;
                $oUser->password=password_hash($request->get('password'), PASSWORD_BCRYPT);
                $oUser->clave=password_hash($request->get('clave'), PASSWORD_BCRYPT);
                $oUser->department='cliente';
                $oUser->type=$typeUser;
                $oUser->active=false;
                $oUser->pregunta1=false;
                $oUser->pregunta1=$request->get('pregunta1');
                $oUser->pregunta2=$request->get('pregunta2');
                $oUser->respuesta1=password_hash($request->get('respuesta1'), PASSWORD_BCRYPT);
                $oUser->respuesta2=password_hash($request->get('respuesta2'), PASSWORD_BCRYPT);
                $oUser->confirm_token=str_random(100);
                $oUser->confirm_token=str_random(100);
                $oUser->detalles_usuario_id=$request->get('afiliado');
              
                // Cambio estatus a pendiente de la cuenta a la espera de confirmación de correo
                
                $afiliado->cuenta->AcCuenta(['estatus' => 2]);
                
                //Guardo data para enviar el correo
      
                    $this->getDI()->getMail()->send(
                        [
                            $oAfiliado->email => $nombre
                        ],
                        "Registro",//subject
                        'confirmRegistro',//templatename
                        [
                            'data' => [
                                'name' => $oUser->name,
                                'email' => $oUser->email,
                                'confirm_token' => $oUser->confirm_token
                            ]
                        ]
                    );
                
                
                    $mensaje='proceso realizado con exito';
                
                    
                    // Retorno mensaje de sastifactorio
                    
                    
            }catch(QueryException $e){
                $mensaje='proceso fallido';;
            }
            
        }
        else
        {
            $mensaje='El usuario ya existe en el sistema';
        
        }
        }
        else
        {
            $mensaje='Afiliado Invalido intente nuevamente';
        }
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = "";//se envia la clave generada para la cita
        $this->_mensajes = [
            "msnConsult" => 'proceso realizo con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
        ];
        
        // var_dump($response);die();
        
        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();
        $this->view->disable();
        
    }
   
    
    public function confirmRegister($email, $confirm_token)
    {
        $user = Users::findFirst('email = "'.$email.'" AND confirm_token = "'.$confirm_token.'"');
        
        if ($user){
            
            if ($user->active == true)
            {
                $mensaje= 'Cuenta de usuario ya se encuentra activa';
            }
            
            // Actualizo usuario activo
            $user->active = true;
            $user->save();
            // Selecciono afiliado para seleccionar cuenta
            //$afiliado =  AcAfiliado::where('email','=',$email)->first();
            $afiliado = AcAfiliado::findFirst([//obtiene el array filtrado
                'conditions' => 'email = :value:',
                'bind' => [
                    'value' =>$email
                ]
            ]);
            // Guardo codigo de cuanta para comparar con tarjetas
            $idcuenta = $afiliado->AcAfiliados->id_cuenta;
            // Selecciono tarjeta
            /*$tarjeta = Tarjeta::get()->filter(function($record) use($codigo) {
                if (Hash::check($codigo, $record->codigo_tarjeta)) {
                    return $record;
                }else{
                    return null;
                }
            })->first();*/
            
            $cuenta = AcCuenta::findById($idcuenta);
            $cuenta->estatus = 1;
            $cuenta->save();
            $criptTarjeta = hash('sha256',sha1(md5($cuenta->codigo_cuenta)));
            $tarjeta  = Tarjeta::findFirst([//obtiene el array filtrado
                'conditions' => 'codigo_tarjeta = :value:',
                'bind' => [
                    'value' =>$criptTarjeta
                ]
            ]);
            // Modifico estatus de tarjeta a usada
            $tarjeta->activada = 'S';
            $tarjeta->save();
            // Actualizo estatus de cuenta
            
            // Retorno msn de felicitaciones
            $mensaje = 'Felicitaciones ya puede iniciar sesión';
        }
        else
        {
            // retorno msn de error
            $mensaje = 'Cuenta de usuario Incorrecta Intente Nuevamente';
        }
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = "";//se envia la clave generada para la cita
        $this->_mensajes = [
            "msnConsult" => 'proceso realizo con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
        ];
        
        // var_dump($response);die();
        
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

