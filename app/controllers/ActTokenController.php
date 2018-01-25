<?php

class ActTokenController extends \Phalcon\Mvc\Controller
{
    private $_mensajes = '';
    private $_data = [];
    private $_afiliados = [];

    public function checkTokenAction()//metodo login del controlador... por ser el metodo de verificacion de credenciales no requiere token..ruta de acceso '/user-login' via post
    {
                $request = $this->request;
                $response = $this->response;
                $token = $request->getPost('token'); 
                if(!isset($token) || empty($token))
                {   
                    $status = 200;
                    $msnStatus = 'OK';
                    $this->_data = null;
                    $this->_mensajes = [
                        "msnConsult" => 'Consulta relizada con exito',
                        "msnToken" => false,//el token de autrización esta ausente
                        "msnInvalid" => null
                    ];
                    
                }else{
                    
                    $datos = JWT::decode($token, "Atiempo-api-rest", ['HS256']);//desencripta el token y se asigna a una variable 'datos'
                    $user = Users::findFirstById($datos->user->id);
                
                //si no existe
                if($user==false)
                {
                    //no es un token correcto
                    $status = 200;
                    $msnStatus = 'OK';
                    $this->_data = null;
                    $this->_mensajes = [
                        "msnConsult" => 'Token Incorrecto',
                        "msnHeaders" => true,
                        "msnInvalid" => true//las credenciales del token de autorizacion son invalidas
                    ];
                }else{
                            if( $user->active == 'S' ){//si esta activo creamos el token de sesión encriptado para el usuario con sus datos para ser enviados a la app

                                $titular = AcAfiliados::findFirstById($user->detalles_usuario_id);//obtenemos los datos del titular de la cuenta
                                $estados = AcEstados::find();//retorna array con los estados
                                $estado = $titular->AcEstados;//retorna datos del estado
                                $tipoDocuments = AcTipoDocumentos::find();//retorna array con los tipos de documentos
                                $documentos = $titular->AcDocumentos;//retorna array con los documentos
                                $listMotivos = Motivos::find();//retorna array con los motivos
                                $listPreferencias = Preferencias::find();//retorna array con los preferencias
                                $listTipoMedicamentos = TipoMedicamentos::find();//retorna array con los tipos medicamentos
                                $contactos = $titular->Contactos;//retorna array con los contactos
                                $habitos = $titular->getMotivoDetalles("id_motivo = '1'");//retorna array con los motivos detalles
                                $actividad = $titular->getMotivoDetalles("id_motivo = '2'");//retorna array con los motivos detalles
                                $pasatiempo = $titular->getMotivoDetalles("id_motivo = '3'");//retorna array con los motivos detalles
                                $alimentacion = $titular->getMotivoDetalles("id_motivo = '4'");//retorna array con los motivos detalles
                                $alergias = $titular->getMotivoDetalles("id_motivo = '5'");//retorna array con los motivos detalles
                                $vacunas = $titular->getMotivoDetalles("id_motivo = '6'");//retorna array con los motivos detalles
                                $discapacidad = $titular->getMotivoDetalles("id_motivo = '7'");//retorna array con los motivos detalles
                                $hospitalizacion = $titular->getMotivoDetalles("id_motivo = '8'");//retorna array con los motivos detalles
                                $operacion = $titular->getMotivoDetalles("id_motivo = '9'");//retorna array con los motivos detalles
                                $enfermedad = $titular->getMotivoDetalles("id_motivo = '10'");//retorna array con los motivos detalles
                                $listMedicamentos = $titular->Medicamentos;//retorna array con los medicamentos
                                $cuenta = [$titular->AcCuenta];

                                //$aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                                $token = [//array que sera encriptado para ser enviado a la app
                                    'user' => $user,
                                    'titular' => $titular,
                                    'estados' => $estados,
                                    'estado' => $estado,
                                    'tipoDocuments' => $tipoDocuments,
                                    'documentos' => $documentos,
                                    'contactos' => $contactos,
                                    'listMotivosDetalles' => $listMotivosDetalles,
                                    'listMotivos' => $listMotivos,
                                    'listPreferencias' => $listPreferencias,
                                    'list' => $listTipoMedicamentos,
                                    'listMedicamentos' => $listMedicamentos,
                                    'habitos' => $habitos,
                                    'actividad' => $actividad,
                                    'pasatiempos' => $pasatiempo,
                                    'alimentacion' => $alimentacion,
                                    'alergias' => $alergias,
                                    'vacunas' => $vacunas,
                                    'discapacidad' => $discapacidad,
                                    'hospitalizacion' => $hospitalizacion,
                                    'operacion' => $operacion,
                                    'enfermedad' => $enfermedad,
                                    'cuenta' => $cuenta
                                ];

                                $status = 200;
                                $msnStatus = 'OK';
                                $this->_data = [
                                    'token' => JWT::encode($token,"Atiempo-api-rest")//creacion del token de sesion encriptado
                                ];
                                $this->_mensajes = [
                                    "msnConsult" => 'Actualizados',
                                ];

                            }else{//en caso de estar inactivo

                                $status = 200;
                                $msnStatus = 'Error';
                                $this->_data = null;
                                $this->_mensajes = [
                                    "msnConsult" => 'Usted se encuentra en estado inactivo',
                                ];

                            }
                
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
