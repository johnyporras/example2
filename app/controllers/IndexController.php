<?php


class IndexController extends ControllerBase
{

    private $_mensajes = '';
    private $_data = '';

    public function route404Action()//metodo del controlador que envia un mensaje de error si la ruta a la que intenta acceder no existe, no requiere ruta de acceso, actua como un evento
    {
        $this->response->setJsonContent('Ruta no valida');
        $this->response->setStatusCode(404, "Error");
        $this->response->send();

        $this->view->disable();

    }

    public function logaoutAction()//metodo que cierra session del usuario, no requiere token...ruta de acceso '/user-logaout' via get (metodo no usado actualmente)
    {
        $response = $this->response;

        if( $this->session->get("id") == null ){

            $status = 500;
            $msnStatus = 'Error';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Usted aun no posee una sesion iniciada',
            ];

        }else{

            $this->session->destroy();

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Session finalizada con exito',
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

    public function pruebaAction()
    {

        $this->view->disable();

    }

    public function indexAction($id)//metodo del controlador que activa la cuenta del usuraio registrado a traves de una variable 'id' via get, no requiere token de validacion...ruta de acceso encriptada '/f5wwluJTnRDBiEZjwasajeJXjuyNs9{id}i6ecJwL9cunuDFfdWkGGOx6' via get
    {

        $user = Users::findFirstById($id);
        $user->active = 'S';

        if( $user->update() ){
            $msn = 'Felicidades has activado tu cuenta correctamente';
        }else{
            $msn = 'Problemas al activar la cuenta, intentelo mas tarde o comuniquese con un administrador del sistema';
       }

        $this->view->setVars([
            'msn' => $msn
        ]);

        $this->view->pick('index/index');

    }

}

