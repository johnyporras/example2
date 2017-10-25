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
                                $cuenta = $titular->AcCuenta;

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

                        if ( $this->security->checkHash($clave, $user->clave))//si el clave que hay en la base de datos coincide con el que ha ingresado el usuairo, le damos luz verde.. los datos son correctos
                        {
                            //validamos el estado del usuario

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
                              $cuenta = $titular->AcCuenta;

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

    public function editPerfilAction(){

        $response = $this->response;
        $request = $this->request;
        $token = $request->getPost('token');//obtiene el token de validacion via post y se asigna a una variable 'token'

        //var_dump($token);die();

        if( !isset($token) || empty($token) ){//se verifica si no existe y si esta vacio

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito no resolvio token',
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

                if( $request->has('pregunta_1'))
                {

                    $auth->pregunta_1 = $request->getPost('pregunta_1');


                }

                if( $request->has('respuesta_1') )
                {

                    $auth->respuesta_1 =password_hash($request->getPost('respuesta_1'), PASSWORD_BCRYPT);

                }

                if( $request->has('pregunta_2') )
                {

                    $auth->pregunta_2 = $request->getPost('pregunta_2');
                }

                if( $request->has('respuesta_2') )
                {

                    $auth->respuesta_2 = password_hash($request->getPost('respuesta_2'), PASSWORD_BCRYPT);
                }

                if( $request->has('password') )
                {
                    $auth->password = password_hash($request->getPost('password'), PASSWORD_BCRYPT);

                }

                if( $request->has('clave') )
                {

                    $auth->clave = password_hash($request->getPost('clave'), PASSWORD_BCRYPT);

                }

                $res  = $auth->save();
               // die();

                if( $request->has('imagebase64') )
                {     
                    $post = [
                        'archivo' => $request->getPost('imagebase64'),
                        'codexamen'=>$auth->id,
                        'tipoarchivo'=>"avatar"
                    ];
    
    
                    //die("fadssad11");
    
    
                    $ch = curl_init('http://18.221.52.114/archivos/procesarArchivo');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    $resp = curl_exec($ch);
                    curl_close($ch);
                    if($resp!==false)
                    {
                        $auth->imagen_perfil= $auth->id.".png";
                        $auth->save();
                    }
                }
                
                if($res)
                {
                        $afiliado = AcAfiliados::findFirstById($auth->detalles_usuario_id);

                        if( $request->has('nombre') ){

                            $afiliado->nombre = $request->getPost('nombre');

                        }

                        if( $request->has('apellido') ){

                            $afiliado->apellido = $request->getPost('apellido');

                        }

                        if( $request->has('email') ){

                            $afiliado->email = $request->getPost('email');

                        }

                        if( $request->has('cedula') ){

                            $afiliado->cedula = $request->getPost('cedula');

                        }

                        if( $request->has('fecha_nacimiento') ){

                            $afiliado->fecha_nacimiento = $request->getPost('fecha_nacimiento');

                        }

                        if( $request->has('ciudad') ){

                            $afiliado->ciudad = $request->getPost('ciudad');

                        }

                        if( $request->has('civil') ){

                            $afiliado->civil = $request->getPost('civil');

                        }

                        if( $request->has('hijos') ){

                            $afiliado->hijos = $request->getPost('hijos');

                        }

                        if( $request->has('telefono') ){

                            $afiliado->telefono = $request->getPost('telefono');

                        }

                        if( $request->has('ocupacion') ){

                            $afiliado->ocupacion = $request->getPost('ocupacion');

                        }

                        if( $request->has('idioma') ){

                            $afiliado->idioma = $request->getPost('idioma');

                        }

                        if( $request->has('id_estado') ){

                            $std = AcEstados::findFirstByEstado($request->getPost('id_estado'));

                            $afiliado->id_estado = $std->id;

                        }

                        if( $request->has('sexo') ){

                            $afiliado->sexo = $request->getPost('sexo');

                        }

                        if( $request->has('altura') ){

                            $afiliado->altura = $request->getPost('altura');

                        }

                        if( $request->has('peso') ){

                            $afiliado->peso = $request->getPost('peso');

                        }

                        if( $request->has('lentes') ){

                            $afiliado->lentes = $request->getPost('lentes');

                        }

                        if( $request->has('grupo_sangre') ){

                            $afiliado->grupo_sangre = $request->getPost('grupo_sangre');

                        }

                        if($afiliado->save()){

                          $titular = AcAfiliados::findFirstById($auth->detalles_usuario_id);//obtenemos los datos del titular de la cuenta
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
                          $cuenta = $titular->AcCuenta;

                          //$aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                          $newToken = [//array que sera encriptado para ser enviado a la app
                              'user' => $auth,
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
                            $this->_data = ["consulta" => true, "token" => JWT::encode($newToken,"Atiempo-api-rest")];
                            $this->_mensajes = [
                                "msnConsult" => 'Consulta relizada con exito',
                                "msnHeaders" => true,//el header de autrización esta ausente
                                "msnInvalid" => false
                            ];

                        }else{

                            $status = 200;
                            $msnStatus = 'OK';
                            $this->_data = ["consulta" => false, "token" => null];
                            $this->_mensajes = [
                                "msnConsult" => 'Consulta relizada con exito',
                                "msnHeaders" => true,//el header de autrización esta ausente
                                "msnInvalid" => false
                            ];

                        }
            }
            else
            {

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = ["consulta" => false, "token" => null];
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                    "msnHeaders" => true,//el header de autrización esta ausente
                    "msnInvalid" => false
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

    public function addContactAction(){

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


                $contact = new Contactos();

                $contact->nombre = $request->getPost('nombre');

                $contact->telefono = $request->getPost('telefono');

                $contact->parentesco = $request->getPost('parentesco');

                $contact->id_afiliado = $datos->titular->id;

                if($contact->save()){

                  $titular = AcAfiliados::findFirstById($auth->detalles_usuario_id);//obtenemos los datos del titular de la cuenta
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
                  $cuenta = $titular->AcCuenta;

                  //$aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                  $newToken = [//array que sera encriptado para ser enviado a la app
                      'user' => $auth,
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
                    $this->_data = ["consulta" => true, "token" => JWT::encode($newToken,"Atiempo-api-rest")];
                    $this->_mensajes = [
                        "msnConsult" => 'Consulta relizada con exito',
                        "msnHeaders" => true,//el header de autrización esta ausente
                        "msnInvalid" => false
                    ];

                }else{

                    $status = 200;
                    $msnStatus = 'OK';
                    $this->_data = ["consulta" => false, "token" => null];
                    $this->_mensajes = [
                        "msnConsult" => 'Consulta relizada con exito',
                        "msnHeaders" => true,//el header de autrización esta ausente
                        "msnInvalid" => false
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

    public function addMotivoDetalleAction(){

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

                $motivo = Motivos::findFirstBySlug($request->getPost('slug'));

                $pasatiempo = new MotivoDetalles();

                if( $request->has('tipo') ){

                    $pasatiempo->tipo = $request->getPost('tipo');

                }

                if( $request->has('cantidad') ){

                    $pasatiempo->cantidad = $request->getPost('cantidad');

                }

                if( $request->has('frecuencia') ){

                    $pasatiempo->frecuencia = $request->getPost('frecuencia');

                }

                if( $request->has('causa') ){

                    $pasatiempo->causa = $request->getPost('causa');

                }

                if( $request->has('fecha') ){

                    $pasatiempo->fecha = $request->getPost('fecha');

                }

                if( $request->has('tratamiento') ){

                    $pasatiempo->tratamiento = $request->getPost('tratamiento');

                }

                if( $request->has('profecional') ){

                    $pasatiempo->profecional = $request->getPost('profecional');

                }

                if( $request->has('comentarios') ){

                    $pasatiempo->comentarios = $request->getPost('comentarios');

                }

                $pasatiempo->id_afiliado = $datos->titular->id;

                $pasatiempo->id_motivo = $motivo->id;

                if($pasatiempo->save()){

                  $titular = AcAfiliados::findFirstById($auth->detalles_usuario_id);//obtenemos los datos del titular de la cuenta
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
                  $cuenta = $titular->AcCuenta;

                  //$aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                  $newToken = [//array que sera encriptado para ser enviado a la app
                      'user' => $auth,
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
                    $this->_data = ["consulta" => true, "token" => JWT::encode($newToken,"Atiempo-api-rest")];
                    $this->_mensajes = [
                        "msnConsult" => 'Consulta relizada con exito',
                        "msnHeaders" => true,//el header de autrización esta ausente
                        "msnInvalid" => false
                    ];

                }else{

                    $status = 200;
                    $msnStatus = 'OK';
                    $this->_data = ["consulta" => false, "token" => null];
                    $this->_mensajes = [
                        "msnConsult" => 'Consulta relizada con exito',
                        "msnHeaders" => true,//el header de autrización esta ausente
                        "msnInvalid" => false
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

    public function addMedicamentoAction(){

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

                $medicamento = new Medicamentos();

                $tipoM = TipoMedicamentos::findFirstByDescripcion($request->getPost('id_tipo_medicamento'));

                $medicamento->nombre = $request->getPost('nombre');

                $medicamento->dosis = $request->getPost('dosis');

                $medicamento->frecuencia = $request->getPost('frecuencia');

                $medicamento->duracion = $request->getPost('duracion');

                $medicamento->recetado = $request->getPost('recetado');

                $medicamento->id_afiliado = $datos->titular->id;

                $medicamento->id_tipo_medicamento = $tipoM->id;

                if($medicamento->save()){

                  $titular = AcAfiliados::findFirstById($auth->detalles_usuario_id);//obtenemos los datos del titular de la cuenta
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
                  $cuenta = $titular->AcCuenta;

                  //$aseguradora = AcAseguradora::findFirstByCodigoAseguradora($colectivo->codigo_aseguradora);

                  $newToken = [//array que sera encriptado para ser enviado a la app
                      'user' => $auth,
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
                    $this->_data = ["consulta" => true, "token" => JWT::encode($newToken,"Atiempo-api-rest")];
                    $this->_mensajes = [
                        "msnConsult" => 'Consulta relizada con exito',
                        "msnHeaders" => true,//el header de autrización esta ausente
                        "msnInvalid" => false
                    ];

                }else{

                    $status = 200;
                    $msnStatus = 'OK';
                    $this->_data = ["consulta" => false, "token" => null];
                    $this->_mensajes = [
                        "msnConsult" => 'Consulta relizada con exito',
                        "msnHeaders" => true,//el header de autrización esta ausente
                        "msnInvalid" => false
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
