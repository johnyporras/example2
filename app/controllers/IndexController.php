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
        $this->getDI()->getMail()->send(
            [
                "javier.alberto.lugo@gmail.com" => "Javier"
            ],
            "Activar Cuenta A Tiempo Api",//subject
            'test',//templatename
            [
                'mensaje' => 'Hola javier, gracias por usar a tiempo api ahora deberas activar tu cuenta haciendo click en el link.. <br>http://35.166.131.103/Atiempo-api/f5wwluJTnRDBiEZjwasajeJXjuyNs95i6ecJwL9cunuDFfdWkGGOx6'
                //'mensaje' => 'Hola javier, gracias por usar a tiempo api ahora deberas activar tu cuenta haciendo click en el link.. <br>http://127.0.0.1/Atiempo-api/f5wwluJTnRDBiEZjwasajeJXjuyNs95i6ecJwL9cunuDFfdWkGGOx6'
            ]
        );

        $this->view->disable();

    }

    public function indexAction($id)
    {

        echo $id;

        $this->view->disable();

    }

}

