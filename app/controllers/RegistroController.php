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
        if($codigo->codTarjeta!="")
        {    
            $tarjeta = hash('sha256',sha1(md5($codigo->codTarjeta)));
            $rsTarjeta = Tarjetas::findFirst([//obtiene el array filtrado
                'conditions' => 'codigo_tarjeta = :value:',
                'bind' => [
                    'value' =>$tarjeta
                ]
            ]);
            
            if($rsTarjeta->count()>0)
            {
                if($rsTarjeta->activada=="N")
                {
                    $rsCuenta = AcCuenta::findFirst([//obtiene el array filtrado
                        'conditions' => 'codigo_tarjeta = :value:',
                        'bind' => [
                            'value' =>$codigo->codTarjeta
                        ]
                    ]);
                    
                    if($rsCuenta->count()>0)
                    {
                        if ($rsCuenta->estatus == 5 ) {
                            // Verifico que tenga algun afiliado
                            if ($rsCuenta->afiliado !== null) {
                                // Elimino usuario si tiene un usuario generado
                                $user = User::findFirst([//obtiene el array filtrado
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
                                $cuenta->AcAfiliados->delete();
                            }
                            // Elimino la cuenta y planes asociados
                            $cuenta->cuentaPlan->delete();
                            $cuenta->delete();
                            // Guardo la session codigo
                          
                            
                            // Guardo el valor del formulario para comparar
                            $code = substr($codigo->codTarjeta, 2, 3);
                            // tipo de plan dependiendo de codigo
                            $plan = substr($codigo->codTarjeta, 0, 2);
                            
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
                            $arrDatos["tplan"]=$tplan;
                            
                          /*  Session::set('terminos', [
                                'code' => $terminos->codigo,
                                'terminos' => $terminos->terminos]);
                            //session con valor del plan
                            Session::set('plan', $tplan);*/
                            
                          }
                            
                            if ( $cuenta->estatus == 2 ) {
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
                        $code = substr($codigo->codTarjeta, 2, 3);
                        // tipo de plan dependiendo de codigo
                        $plan = substr($codigo->codTarjeta, 0, 2);
                        
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
                        $arrDatos["tplan"]=$tplan;
                        
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
    
    public function searchExamenesAction()//metodo del controlador que retorna un array filtrado a traves de la variable post 'id', no requiere token de validacion...ruta de acceso '/estado-search' via post
    {
       
        $response = $this->response;
        $request = $this->request;
        
        $historial = HistorialMedico::findFirst($request->get('idHistorial'));
        
        $examenes = $historial->HistorialExamenes;
        //var_dump($res);
        foreach ($examenes as $item ){
            
            $this->_listExam[] = $item;
            
        }
        
        
        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            "examanes" => $this->_listExam
        ];//arra enviado a la app
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

