<?php

use Phalcon\Mvc\Model\Transaction\Manager as Transaction;

class OperadorController extends \Phalcon\Mvc\Controller
{

    private $_list = [];
    private $_msnValidation = [];

    public function listOperAction()//metodo del controlador que retorna un array de todos los usuarios, no requiere token de validacion...ruta de acceso '/user-list' via get
    {

        $response = $this->response;

        $listUser = Users::find([//obtiene el array filtrado
            'conditions' => 'type = :value:',
            'bind' => [
                'value' =>9
            ]
        ]);//obtiene el array con todos los usuarios

        foreach ( $listUser as $item ){

            $arr["id"] = $item->Operador->id;
            $arr["nombre"] = $item->Operador->nombre;
            $arr["apellido"] = $item->Operador->apellido;
            $arr["email"] = $item->Operador->email;
            array_push($this->_list,$arr);

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
