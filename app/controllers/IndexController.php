<?php


class IndexController extends ControllerBase
{

    private $_mensajes = '';
    private $_data = '';

    public function route404Action()
    {
        $this->response->setJsonContent('Ruta no valida');
        $this->response->setStatusCode(404, "Error");
        $this->response->send();

        $this->view->disable();

    }

    public function logaoutAction()
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

    public function indexAction($id)
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

