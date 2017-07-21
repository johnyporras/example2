<?php

class ApiController extends \Phalcon\Mvc\Controller
{
    private $_mensajes = '';
    private $_data = [];
    private $_afiliados = [];

    public function loginAction()//metodo login del controlador... por ser el metodo de verificacion de credenciales no requiere token..ruta de acceso '/user-login' via post
    {
        $request = $this->request;
        $response = $this->response;

        if ( $request->isPost() ) {//verifica que la peticion post exite

            $usuario = $request->getPost('usuario');//variable requerida para la verificacion de la cuenta

            $password = $request->getPost('password');//variable requerida para la verificacion de la cuenta

            if ( $this->security->checkToken($this->security->getTokenKey(), $this->security->getToken()) ) {//token de seguridad del usuario (Por el momento no usada)

                $validarLogin = new ValidationLogin();//contiene la validacion de las variables de formulario

                $mensagesLogin = $validarLogin->validate($_POST);//se le pasan las variables tomadas de la peticion post y se asigna a una variable

                if ( $mensagesLogin->count() ) {//verifica si contiene un mensaje de validacion en caso de que alla fallado la validacion

                    foreach ($mensagesLogin->filter('usuario') as $message) {//filtra uno a uno los mensajes de la variable 'usuario'
                        $msnUsuario[] =  $message->getMessage();//obtiene los mensajes y los asigna a un array
                    }

                    foreach ($mensagesLogin->filter('password') as $message) {//filtra uno a uno los mensajes de la variable 'password'
                        $msnPassword[] =  $message->getMessage();//obtiene los mensajes y los asigna a un array
                    }

                    $status = 200;
                    $msnStatus = 'Error';
                    $this->_data = null;
                    $this->_mensajes = [
                        "msnConsult" => 'Error de Credenciales',
                        "msnUsuario" => $msnUsuario[0],//mensajes de validacion
                        "msnPassword" =>$msnPassword[0]//mensajes de validacion
                    ];

                }else{//en caso de que alla pasado las validaciones correctamente pasamos a la verificacion de las credenciales

                    $user = Users::findFirstByUser($usuario);//obtenemos al usuario por su nombre usuario

                    if ($user)//si existe el usuario buscado por nombre usuario
                    {

                        if ($this->security->checkHash($password, $user->password))//si el password que hay en la base de datos coincide con el que ha ingresado el usuairo, le damos luz verde.. los datos son correctos
                        {
                            //validamos el estado del usuario

                            if( $user->active == 'S' ){//si esta activo creamos el token de sesión encriptado para el usuario con sus datos para ser enviados a la app

                                $titular = AcAfiliados::findFirstById($user->detalles_usuario_id);//obtenemos los datos del titular de la cuenta

                              //  $aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                                $token = [//array que sera encriptado para ser enviado a la app
                                    'user' => $user,
                                    'titular' => $titular,
                                ];

                                $status = 200;
                                $msnStatus = 'OK';
                                $this->_data = [
                                    'token' => JWT::encode($token,"Atiempo-api-rest")//creacion del token de sesion encriptado
                                ];
                                $this->_mensajes = [
                                    "msnConsult" => 'Datos correctos',
                                ];

                            }else{//en caso de estar inactivo

                                $status = 200;
                                $msnStatus = 'Error';
                                $this->_data = null;
                                $this->_mensajes = [
                                    "msnConsult" => 'Usted se encuentra en estado inactivo',
                                ];

                            }

                        }else{//en caso de que el password enviado por el usuario no coincida con el de la base de datos

                            $status = 200;
                            $msnStatus = 'Error';
                            $this->_data = null;
                            $this->_mensajes = [
                                "msnConsult" => 'Usuario o clave incorrectos',
                            ];

                        }

                    }else{//en caso de que la busqueda por nombre de usuario no retorne ningun objeto

                        $status = 200;
                        $msnStatus = 'Error';
                        $this->_data = null;
                        $this->_mensajes = [
                            "msnConsult" => 'Usuario o clave incorrectos',
                        ];

                    }

                }

            }else{//en caso de fallar la verificacion del formulario manda un mensaje (Por el momento no usado)

                $status = 200;
                $msnStatus = 'Error';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Problemas de validacion del formulario',//mensaje enviado en caso de fallar la verificacion del formulario
                ];

            }

        }else{//de no esxistir la peticion por post manda un mensaje

            $status = 200;
            $msnStatus = 'Error';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Debe ser unapetición detipo POST',//mensaje enviado en caso de no ser una peticion post
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

    public function loginTelAction()//metodo login del controlador... por ser el metodo de verificacion de credenciales no requiere token..ruta de acceso '/user-login' via post
    {
        $request = $this->request;
        $response = $this->response;

        if ( $request->isPost() ) {//verifica que la peticion post exite

            $usuario = $request->getPost('usuario');//variable requerida para la verificacion de la cuenta

            $clave = $request->getPost('clave');//variable requerida para la verificacion de la cuenta

            if ( $this->security->checkToken($this->security->getTokenKey(), $this->security->getToken()) ) {//token de seguridad del usuario (Por el momento no usada)

                $validarLogin = new ValidationLoginTel();//contiene la validacion de las variables de formulario

                $mensagesLogin = $validarLogin->validate($_POST);//se le pasan las variables tomadas de la peticion post y se asigna a una variable

                if ( $mensagesLogin->count() ) {//verifica si contiene un mensaje de validacion en caso de que alla fallado la validacion

                    foreach ($mensagesLogin->filter('usuario') as $message) {//filtra uno a uno los mensajes de la variable 'usuario'
                        $msnUsuario[] =  $message->getMessage();//obtiene los mensajes y los asigna a un array
                    }

                    foreach ($mensagesLogin->filter('clave') as $message) {//filtra uno a uno los mensajes de la variable 'clave'
                        $msnClave[] =  $message->getMessage();//obtiene los mensajes y los asigna a un array
                    }

                    $status = 200;
                    $msnStatus = 'Error';
                    $this->_data = null;
                    $this->_mensajes = [
                        "msnConsult" => 'Error de Credenciales',
                        "msnUsuario" => $msnUsuario[0],//mensajes de validacion
                        "msnClave" =>$msnClave[0]//mensajes de validacion
                    ];

                }else{//en caso de que alla pasado las validaciones correctamente pasamos a la verificacion de las credenciales

                    $user = Users::findFirstByUser($usuario);//obtenemos al usuario por su nombre usuario

                    if ($user)//si existe el usuario buscado por nombre usuario
                    {

                        if ( $clave === $user->claveTel )//si el clave que hay en la base de datos coincide con el que ha ingresado el usuairo, le damos luz verde.. los datos son correctos
                        {
                            //validamos el estado del usuario

                            if( $user->active == 'S' ){//si esta activo creamos el token de sesión encriptado para el usuario con sus datos para ser enviados a la app

                                $titular = AcAfiliados::findFirstById($user->detalles_usuario_id);//obtenemos los datos del titular de la cuenta

                              //  $aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                                $token = [//array que sera encriptado para ser enviado a la app
                                    'user' => $user,
                                    'titular' => $titular,
                                ];

                                $status = 200;
                                $msnStatus = 'OK';
                                $this->_data = [
                                    'token' => JWT::encode($token,"Atiempo-api-rest")//creacion del token de sesion encriptado
                                ];
                                $this->_mensajes = [
                                    "msnConsult" => 'Datos correctos',
                                ];

                            }else{//en caso de estar inactivo

                                $status = 200;
                                $msnStatus = 'Error';
                                $this->_data = null;
                                $this->_mensajes = [
                                    "msnConsult" => 'Usted se encuentra en estado inactivo',
                                ];

                            }

                        }else{//en caso de que la clave enviado por el usuario no coincida con el de la base de datos

                            $status = 200;
                            $msnStatus = 'Error';
                            $this->_data = null;
                            $this->_mensajes = [
                                "msnConsult" => 'Usuario o clave incorrectos',
                            ];

                        }

                    }else{//en caso de que la busqueda por nombre de usuario no retorne ningun objeto

                        $status = 200;
                        $msnStatus = 'Error';
                        $this->_data = null;
                        $this->_mensajes = [
                            "msnConsult" => 'Usuario o clave incorrectos',
                        ];

                    }

                }

            }else{//en caso de fallar la verificacion del formulario manda un mensaje (Por el momento no usado)

                $status = 200;
                $msnStatus = 'Error';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Problemas de validacion del formulario',//mensaje enviado en caso de fallar la verificacion del formulario
                ];

            }

        }else{//de no esxistir la peticion por post manda un mensaje

            $status = 200;
            $msnStatus = 'Error';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Debe ser unapetición detipo POST',//mensaje enviado en caso de no ser una peticion post
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
