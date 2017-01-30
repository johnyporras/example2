<?php

class UsersController extends \Phalcon\Mvc\Controller
{

    private $_list = [];

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

}

