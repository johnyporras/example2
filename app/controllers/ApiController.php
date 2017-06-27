<?php

class ApiController extends \Phalcon\Mvc\Controller
{
    private $_mensajes = '';
    private $_data = [];
    private $_afiliados = [];

    public function loginAction()
    {
        $request = $this->request;
        $response = $this->response;

        if ( $request->isPost() ) {

            $usuario = $request->getPost('usuario');

            $password = $request->getPost('password');

            if ( $this->security->checkToken($this->security->getTokenKey(), $this->security->getToken()) ) {

                $validarLogin = new ValidationLogin();

                $mensagesLogin = $validarLogin->validate($_POST);

                if ( $mensagesLogin->count() ) {

                    foreach ($mensagesLogin->filter('usuario') as $message) {
                        $msnUsuario[] =  $message->getMessage();
                    }

                    foreach ($mensagesLogin->filter('password') as $message) {
                        $msnPassword[] =  $message->getMessage();
                    }

                    $status = 200;
                    $msnStatus = 'Error';
                    $this->_data = null;
                    $this->_mensajes = [
                        "msnConsult" => 'Error de Credenciales',
                        "msnUsuario" => $msnUsuario[0],
                        "msnPassword" =>$msnPassword[0]
                    ];

                }else{

                    //obtenemos al usuario por su nombre usuario

                    $user = Users::findFirstByUser($usuario);

                    //si existe el usuario buscado por nombre usuario

                    if ($user)
                    {
                        //si el password que hay en la base de datos coincide con el que ha
                        //ingresado encriptado, le damos luz verde, los datos son correctos
                        if ($this->security->checkHash($password, $user->password))
                        {
                            //validamos el estado del usuario

                            if( $user->active == 'S' ){

                                //si esta activo creamos la sesión del usuario con sus datos

                                $titular = AcAfiliados::findFirstById($user->detalles_usuario_id);

                              //  $aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                                $token = [
                                    'user' => $user,
                                    'titular' => $titular,
                                ];

                                $status = 200;
                                $msnStatus = 'OK';
                                $this->_data = [
                                    'token' => JWT::encode($token,"Atiempo-api-rest")
                                ];
                                $this->_mensajes = [
                                    "msnConsult" => 'Datos correctos',
                                ];

                            }else{

                                $status = 200;
                                $msnStatus = 'Error';
                                $this->_data = null;
                                $this->_mensajes = [
                                    "msnConsult" => 'Usted se encuentra en estado inactivo',
                                ];

                            }

                        }else{

                            $status = 200;
                            $msnStatus = 'Error';
                            $this->_data = null;
                            $this->_mensajes = [
                                "msnConsult" => 'Usuario o clave incorrectos',
                            ];

                        }

                    }else{

                        $status = 200;
                        $msnStatus = 'Error';
                        $this->_data = null;
                        $this->_mensajes = [
                            "msnConsult" => 'Usuario o clave incorrectos',
                        ];

                    }

                }

            }else{

                $status = 200;
                $msnStatus = 'Error';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Problemas de validacion del formulario',
                ];

            }

        }else{

            $status = 200;
            $msnStatus = 'Error';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Debe ser unapetición detipo POST',
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
