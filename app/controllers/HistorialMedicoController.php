<?php
//use namespace as alias;
class HistorialMedicoController extends \Phalcon\Mvc\Controller
{

	private $_listHist = [];
	private $_listExam = [];
	private $_mensajes = '';
    private $_data = '';



    public function searchAction()//metodo del controlador que retorna un array filtrado a traves de la variable post 'id', no requiere token de validacion...ruta de acceso '/estado-search' via post
    {
        $response = $this->response;
        $request = $this->request;

        $historial = HistorialMedico::find([//obtiene el array filtrado
            'conditions' => 'id_afiliado = :value:',
            'bind' => [
                'value' => $request->get('idAfiliado')
            ]
        ]);

       //var_dump($res);
        foreach ( $historial as $item ){

            $this->_listHist[] = $item;

        }


        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            "historial" => $this->_listHist
        ];//arra enviado a la app
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
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

    public function searchExamenesAction()//metodo del controlador que retorna un array filtrado a traves de la variable post 'id', no requiere token de validacion...ruta de acceso '/estado-search' via post
    {

        $response = $this->response;
        $request = $this->request;

        $historial = HistorialMedico::findFirst($request->get('idHistorial'));

        $examenes = $historial->HistorialExamenes;
        //var_dump($res);
        foreach ($examenes as $item ){

            $this->_listExam[] = $item;

        }


        $status = 200;
        $msnStatus = 'OK';
        $this->_data = [
            "examanes" => $this->_listExam
        ];//arra enviado a la app
        $this->_mensajes = [
            "msnConsult" => 'Consulta relizada con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
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

    public function incHistorialAction()
    {
        $response = $this->response;
        $request = $this->request;

        //var_dump($request->get());die();

        $objDatos =  json_decode($request->get('obj'));
        //$objDatos =  $request->get('obj');
        $oHistorial = new HistorialMedico();
       // var_dump($objDatos);die();
        $oHistorial->id_user = $objDatos->id_user;
        $oHistorial->id_afiliado = $objDatos->id_afiliado;
        $oHistorial->fecha = $objDatos->fecha;
        $oHistorial->motivo = $objDatos->motivo;
        $oHistorial->observaciones = $objDatos->observaciones;
        $oHistorial->especialidad = $objDatos->especialidad;
        $oHistorial->tratamiento = $objDatos->tratamiento;
        $oHistorial->procedimiento = $objDatos->procedimiento;
        $oHistorial->medico = $objDatos->medico;
        $oHistorial->recomendaciones = $objDatos->recomendaciones;
        $oHistorial->diagnostico = $objDatos->diagnostico;
        $oHistorial->save();

        //aqui se mandan los detalles de los servicios que tienen que ver con la espacialidad, de igual forma estos valores los puedes chekr una vez se guarden

        foreach ($objDatos->detailExamen as $item )
        {

            $Detalle = new HistorialExamenes();
            $Detalle->id_historial = $oHistorial->id;
            //$Detalle->examen = $item->examen;
            if($Detalle->save())
            {
                $Detalle->examen=$Detalle->id.".png";
                $Detalle->update();
								if(strpos($image,"base64,") > 0){
									$img_base64 = substr($item->base64,strpos($item->base64,"base64,")+7,strlen($item->base64));
								}else{
									$img_base64 = $item->base64;
								}
                $post = [
                    'archivo' => $img_base64,
                    'codexamen'=>$Detalle->id
                ];

                $ch = curl_init('http://18.221.52.114/archivos/procesarArchivo');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $resp = curl_exec($ch);
                curl_close($ch);
            }

        }


        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $oHistorial->id;//se envia la clave generada para la cita
        $this->_mensajes = [
            "msnConsult" => 'proceso realizo con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
        ];

       // var_dump($response);die();

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();
        $this->view->disable();


    }


    public function actHistorialAction()
    {
        $response = $this->response;
        $request = $this->request;

        //var_dump($request->get());die();


        $objDatos =  json_decode($request->get('obj'));
        $oHistorial =  HistorialMedico::findFirst($objDatos->idHistorial);
     //   var_dump($oHistorial);die();
        $oHistorial->id_user = $objDatos->id_user;
        $oHistorial->id_afiliado = $objDatos->id_afiliado;
        $oHistorial->fecha = $objDatos->fecha;
        $oHistorial->motivo = $objDatos->motivo;
        $oHistorial->observaciones = $objDatos->observaciones;
        $oHistorial->especialidad = $objDatos->especialidad;
        $oHistorial->tratamiento = $objDatos->tratamiento;
        $oHistorial->procedimiento = $objDatos->procedimiento;
        $oHistorial->medico = $objDatos->medico;
        $oHistorial->recomendaciones = $objDatos->recomendaciones;
        $oHistorial->diagnostico = $objDatos->diagnostico;
        $oHistorial->update();

        //aqui se mandan los detalles de los servicios que tienen que ver con la espacialidad, de igual forma estos valores los puedes chekr una vez se guarden

        $status = 200;
        $msnStatus = 'OK';
        $this->_data = $oHistorial->id;//se envia la clave generada para la cita
        $this->_mensajes = [
            "msnConsult" => 'proceso realizo con exito',
            "msnHeaders" => true,//el header de autrización esta ausente
            "msnInvalid" => false
        ];

        // var_dump($response);die();

        $response->setJsonContent([
            "status" => $status,
            "mensajes" => $this->_mensajes,
            "data" => $this->_data,
        ]);
        $response->setStatusCode($status, $msnStatus);
        $response->send();
        $this->view->disable();


    }

    public function elimExamenAction()
    {
        $response = $this->response;
        $request = $this->request;
        $examen = HistorialExamenes::findFirst($request->get("idExamen"));
        if($examen->delete())
        {
            $status = 200;
            $msnStatus = 'OK';
            $this->_data = $oHistorial->id;//se envia la clave generada para la cita
            $this->_mensajes = [
                "msnConsult" => 'proceso realizo con exito',
                "msnHeaders" => true,//el header de autrización esta ausente
                "msnInvalid" => false
            ];



        }
        else
        {
            $status = 400;
            $msnStatus = 'false';
            $this->_data ="";//se envia la clave generada para la cita
            $this->_mensajes = [
                "msnConsult" => 'proceso no se realizo con exito',
                "msnHeaders" => true,//el header de autrización esta ausente
                "msnInvalid" => true
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
