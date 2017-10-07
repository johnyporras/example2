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
                            
                            $mensaje="cuenta creada";
                            $arrDatos["terminos"]=$terminos;
                            $arrDatos["plan"]=$tplan;
                            
                          /*  Session::set('terminos', [
                                'code' => $terminos->codigo,
                                'terminos' => $terminos->terminos]);
                            //session con valor del plan
                            Session::set('plan', $tplan);*/
                            
                          }
                            
                          if ( $rsCuenta->estatus == 2 ) {
                                $mensaje="cuenta creada";
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
                        
                        $mensaje="cuenta creada";
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
    
    
    public function checkTerminos()
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
    
    
    
    
    public function crearCuenta()
    {
        
        $response = $this->response;
        $request = $this->request;
        
        $datos="";
        if ($request->get('codigo')!="")
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
        }
        
        
        try
        {
            $oCuenta = new AcCuenta();
            $oCuenta->codigo_cuenta=$request->get('codigo');
            $oCuenta->fecha= date("Y-m-d");
            $oCuenta->producto= $producto;
            $oCuenta->producto= 5;
            $oCuenta->acepto_terminos=date("Y-m-d");;
            if($oCuenta->save())
            {
                $oCuentaPlan = new AcCuentaPlan();
                $oCuentaPlan->id_cuenta=$oCuenta->id;
                $oCuentaPlan->id_plan=substr($request->get('codigo'), 0, 2);
                $oCuentaPlan->save();
                
                if($request->plan==8)
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
            
        }
        catch(QueryException $e)
        {
            return response()->json(['error' => '¡Ocurrio un error al generar cuenta!',
                'data' => $e ]);
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
            $emailAf = AcAfiliado::where('email','=', $request->correo)->first();
            $emailUser = User::where('email','=', $request->correo)->first();
            $cedulaAf = AcAfiliado::where('cedula','=', $request->cedula)->first();
            //Guardo variables para embarazo
            $embarazo = $request->get('embarazo');
            
            if ($emailAf != null || $emailUser != null){
                return response()->json(['error' => 'El Correo que ingreso ya esta en uso']);
            }
            
            if($cedulaAf != null){
                return response()->json(['error' => 'La cédula que ingreso ya existe en el sistema']);
            }
            
            
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
            
            $embarazo = ($request->get("cedula")) ? Session::get('embarazo') : 'N';
            
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
            
                try
                {
                    $afiliado = AcAfiliado::create([
                        'cedula'    => $request->cedula,
                        'nombre'    => $request->nombre,
                        'apellido'  => $request->apellido,
                        'fecha_nacimiento' => $request->nacimiento,
                        'email'     => $request->correo,
                        'sexo'      => $request->sexo,
                        'telefono'  => $request->telefono,
                        'id_cuenta' => Session::get('cuenta')->id,
                        'id_estado' => $request->estado,
                        'ciudad'    => $request->ciudad,
                        'embarazada' => $embarazo,
                        'tiempo_gestacion' => Session::get('semanas')
                    ]);
                    
                    // Guardo la session cuenta
                    Session::set('afiliado', $afiliado);
                    // borro la session cuenta
                    Session::forget('embarazo');
                    Session::forget('semanas');
                    // Retorno mensaje de sastifactorio
                    return response()->json(['success' => 'Afiliado creado Sastifactorimente']);
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
                    $mensaje='¡Ocurrio un error al generar cuenta!';
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
    
    public function incHistorialAction()
    {
        $response = $this->response;
        $request = $this->request;
        
        //var_dump($request->get());die();
        
        //$objDatos =  json_decode($request->get('obj'));
        $objDatos =  $request->get('obj');
        $oHistorial = new HistorialMedico();
       // var_dump($objDatos);die();
        $oHistorial->id_user = $objDatos->id_user;
        $oHistorial->id_afiliado = $objDatos->id_afiliado;
        $oHistorial->fecha = $objDatos->fecha;
        $oHistorial->motivo = $objDatos->motivo;
        $oHistorial->observaciones = $objDatos->observaciones;
        $oHistorial->especialidad = $objDatos->especialidad;
        $oHistorial->tratamiento = $objDatos->tratamiento;
        $oHistorial->procedimiento = $objDatos->procedimiento;
        $oHistorial->medico = $objDatos->medico;
        $oHistorial->recomendaciones = $objDatos->recomendaciones;
        $oHistorial->diagnostico = $objDatos->diagnostico;
        $oHistorial->save();
        
        //aqui se mandan los detalles de los servicios que tienen que ver con la espacialidad, de igual forma estos valores los puedes chekr una vez se guarden
        
        foreach ($objDatos->detailExamen as $item )
        {
            
            $Detalle = new HistorialExamenes();
            $Detalle->id_historial = $oHistorial->id;
            //$Detalle->examen = $item->examen;
            if($Detalle->save())
            {         
                $Detalle->examen=$Detalle->id.".png";
                $Detalle->update();
                $post = [
                    'archivo' => $item->base64,
                    'codexamen'=>$Detalle->id
                ];
                
                $ch = curl_init('http://18.221.52.114/archivos/procesarArchivo');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $resp = curl_exec($ch);
                curl_close($ch);
            }
            
        }
        
              
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $oHistorial->id;//se envia la clave generada para la cita
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
    
    
    public function actHistorialAction()
    {
        $response = $this->response;
        $request = $this->request;
        
        //var_dump($request->get());die();
        
       
        $objDatos =  json_decode($request->get('obj'));
        $oHistorial =  HistorialMedico::findFirst($objDatos->idHistorial);
     //   var_dump($oHistorial);die();
        $oHistorial->id_user = $objDatos->id_user;
        $oHistorial->id_afiliado = $objDatos->id_afiliado;
        $oHistorial->fecha = $objDatos->fecha;
        $oHistorial->motivo = $objDatos->motivo;
        $oHistorial->observaciones = $objDatos->observaciones;
        $oHistorial->especialidad = $objDatos->especialidad;
        $oHistorial->tratamiento = $objDatos->tratamiento;
        $oHistorial->procedimiento = $objDatos->procedimiento;
        $oHistorial->medico = $objDatos->medico;
        $oHistorial->recomendaciones = $objDatos->recomendaciones;
        $oHistorial->diagnostico = $objDatos->diagnostico;
        $oHistorial->update();
        
        //aqui se mandan los detalles de los servicios que tienen que ver con la espacialidad, de igual forma estos valores los puedes chekr una vez se guarden
            
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $oHistorial->id;//se envia la clave generada para la cita
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
    
    public function elimExamenAction()
    {
        $response = $this->response;
        $request = $this->request;
        $examen = HistorialExamenes::findFirst($request->get("idExamen"));
        if($examen->delete())
        {
            $status = 200;
            $msnStatus = 'OK';
            $this->_data = $oHistorial->id;//se envia la clave generada para la cita
            $this->_mensajes = [
                "msnConsult" => 'proceso realizo con exito',
                "msnHeaders" => true,//el header de autrización esta ausente
                "msnInvalid" => false
            ];
            
            
            
        }
        else
        {
            $status = 400;
            $msnStatus = 'false';
            $this->_data ="";//se envia la clave generada para la cita
            $this->_mensajes = [
                "msnConsult" => 'proceso no se realizo con exito',
                "msnHeaders" => true,//el header de autrización esta ausente
                "msnInvalid" => true
            ];
            
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

