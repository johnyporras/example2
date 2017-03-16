<?php

use Phalcon\Mvc\Model\Transaction\Manager as Transaction;

class UsersController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_msnValidation = [];

    public function listAction()
    {

        $response = $this->response;

        $listUser = Users::find();

        foreach ( $listUser as $item ){

            $this->_list[] = $item;

        }

        $response->setJsonContent([
            "status" => 200,
            "data" => $this->_list,
        ]);
        $response->setStatusCode(200, 'OK');
        $response->send();

        $this->view->disable();

    }

    public function verifAction()
    {

        $response = $this->response;
        $request = $this->request;

        $afiliado = AcAfiliados::findFirst([
            'conditions' => 'cedula = :cedula: AND fecha_nacimiento = :fecha:',
            'bind' => [
                'cedula' => $request->getPost('cedula'),
                'fecha' => $request->getPost('fecha')
            ]
        ]);

        if( isset($afiliado->email) ){

            $user = Users::findFirstByEmail($afiliado->email);

        }

        if(!$afiliado){

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = ['msn' => 'Usted no se encuentra afiliado en el sistema', 'status' => false];
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito',
            ];

        }else if($afiliado && $user){

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = ['msn' => 'Usted ya posee un usuario en el sistema', 'status' => false];
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito',
            ];

        }else if( $afiliado && !$user ){

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = ['msn' => '', 'status' => true, 'afiliado' => $afiliado];
            $this->_mensajes = [
                "msnConsult" => 'Consulta relizada con exito',
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

    public function addAction()
    {

        $response = $this->response;
        $request = $this->request;

        $validateDatos = new ValidationRegistro();

        $uniqueUser = Users::findFirstByUser($request->getPost('user'));

        $uniqueEmail = Users::findFirstByEmail($request->getPost('email'));

        $msnRegis = $validateDatos->validate($request->getPost());

        if ( count($msnRegis) ) {

            foreach ($msnRegis as $message) {

                $this->_msnValidation[] = $message->getMessage();

            }

        }else if( $uniqueUser ){

            $this->_msnValidation[] = 'El nombre de Usuario: '.$request->getPost('user').', ya se encuentra en uso';

        }else if( $uniqueEmail ){

            $this->_msnValidation[] = 'El Email: '.$request->getPost('email').', ya se encuentra en uso';

        }else if( $request->getPost('password') != $request->getPost('repClave') ){

            $this->_msnValidation[] = 'las contraseñas no coinciden';

        }else{

            try{

                $transactionManager = new Transaction();

                $transaction = $transactionManager->get();

                $user = new Users();

                $user->name = $request->getPost('name');
                $user->email = $request->getPost('email');
                $user->password = $this->security->hash($request->getPost('password'));
                $user->department = 'Sistemas';
                $user->type = 2;
                $user->user = $request->getPost('user');
                $user->active = 'N';
                $user->proveedor = 1;

                if (!$user->save()){

                    $transaction->rollback("Problemas durate el registro de usuario, por favor intentelo mas tarde o comuniquese con un administrador del sistema");

                }

                $this->getDI()->getMail()->send(
                    [
                        $user->email => $user->name
                    ],
                    "Activar Cuenta A Tiempo Api",//subject
                    'test',//templatename
                    [
                        'mensaje' => 'Hola '.$user->name.', gracias por usar a tiempo api ahora deberas activar tu cuenta haciendo click en el link.. <br>http://35.166.131.103/Atiempo-api/f5wwluJTnRDBiEZjwasajeJXjuyNs9'.$user->id.'i6ecJwL9cunuDFfdWkGGOx6'
                    ]
                );

                $transaction->commit();

            }catch (Phalcon\Mvc\Model\Transaction\Failed $e){

                $this->_msnValidation[] = $e->getMessage();

            }

        }

        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $this->_msnValidation ? $this->_msnValidation : 'Usuario creado correctamente';
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

}

