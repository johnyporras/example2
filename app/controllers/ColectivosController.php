<?php

class ColectivosController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_mensajes = '';
    private $_data = '';

    public function allAction()
    {

        $response = $this->response;
        $request = $this->request;

        if ( $this->session->get("id") == null ) {

            $status = 500;
            $msnStatus = 'Error';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Usted aun no posee una sesion iniciada',
            ];

        }else{

            $colectivos = AcColectivos::find();

            foreach ( $colectivos as $item ){

                $this->_list[] = $item;

            }

            $status = 200;
            $msnStatus = 'OK';
            $this->_data = $this->_list;
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

    public function searchAction(){

        $response = $this->response;
        $request = $this->request;

        if ( $this->session->get("id") == null ) {

            $status = 500;
            $msnStatus = 'Error';
            $this->_data = null;
            $this->_mensajes = [
                "msnConsult" => 'Usted aun no posee una sesion iniciada',
            ];

        }else{

            $colectivo = AcColectivos::findFirstById( $request->getPost('id') );

            if ( $colectivo ) {

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = $colectivo;
                $this->_mensajes = [
                    "msnConsult" => 'Consulta relizada con exito',
                ];

            }else{

                $status = 200;
                $msnStatus = 'OK';
                $this->_data = null;
                $this->_mensajes = [
                    "msnConsult" => 'Ningun resultado obtenido',
                ];

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

