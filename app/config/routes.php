<?php
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;

// Create a group with a common module and controller

$apiUrl = new RouterGroup(
    [
        //"module"     => "blog",
        "controller" => "Api",
    ]
);

$router = new Router(false);

// All the routes start with /blog
$apiUrl->setPrefix("/api-rest");

$router->addGet("/prueba", [

    'controller' => 'index',

    'action' => 'prueba'

])->setName('prueba');

$router->addGet("/f5wwluJTnRDBiEZjwasajeJXjuyNs9{id}i6ecJwL9cunuDFfdWkGGOx6", [

    'controller' => 'index',

    'action' => 'index'

])->setName('activate');

/***************************************************
********************rutas Api***********************
***************************************************/

$apiUrl->addPost(
    "/user-login",
    [
        "action" => "login",
    ]
)->setName('login');

$apiUrl->addPost(
    "/login-tel",
    [
        "action" => "loginTel",
    ]
)->setName('loginTel');

$apiUrl->addPost(
    "/edit-perfil",
    [
        "action" => "editPerfil",
    ]
)->setName('editPerfil');

$apiUrl->addPost(
    "/add-contacto",
    [
        "action" => "addContact",
    ]
)->setName('addContact');

$apiUrl->addPost(
    "/add-detalle-motivo",
    [
        "action" => "addMotivoDetalle",
    ]
)->setName('addPasatiempo');

$apiUrl->addPost(
    "/add-medicamento",
    [
        "action" => "addMedicamento",
    ]
)->setName('addPasatiempo');

$apiUrl->addPost(
    "/user-verificar",
    [
        "controller" => "users",
        "action" => "verif",
    ]
)->setName('addUser');

$apiUrl->addPost(
    "/user-add",
    [
        "controller" => "users",
        "action" => "add",
    ]
)->setName('addUser');

$apiUrl->addGet(
    "/user-list",
    [
        "controller" => "users",
        "action" => "list",
    ]
)->setName('listUser');

/***************************************************
********************rutas estados*******************
***************************************************/

$apiUrl->addGet(
    "/estados-list",
    [
        "controller" => "estados",
        "action" => "all",
    ]
)->setName('allEstados');

$apiUrl->addPost(
    "/estado-search",
    [
        "controller" => "estados",
        "action" => "search",
    ]
)->setName('searchEstado');

/***************************************************
*******************rutas ciudades*******************
***************************************************/

$apiUrl->addPost(
    "/ciudades-list",
    [
        "controller" => "profesionales",
        "action" => "listCiudades",
    ]
)->setName('listCiudades');

$apiUrl->addPost(
    "/buscar-ciudades",
    [
        "controller" => "estados",
        "action" => "searchCiudades",
    ]
)->setName('searchCiudades');

/***************************************************
*****************rutas profesionales****************
***************************************************/

$apiUrl->addPost(
    "/profesionales-list",
    [
        "controller" => "profesionales",
        "action" => "listProf",
    ]
)->setName('listProf');

/***************************************************
******************rutas afiliados*******************
***************************************************/

$apiUrl->addPost(
    "/afiliado-search",
    [
        "controller" => "afiliados",
        "action" => "search",
    ]
)->setName('searchAfiliados');

/***************************************************
******************rutas aseguradoras****************
***************************************************/

$apiUrl->addGet(
    "/aseguradoras-list",
    [
        "controller" => "aseguradoras",
        "action" => "all",
    ]
)->setName('listAseguradoras');

$apiUrl->addPost(
    "/aseguradora-search",
    [
        "controller" => "aseguradoras",
        "action" => "search",
    ]
)->setName('searchAseguradora');

/***************************************************
******************rutas colectivos******************
***************************************************/

/*$apiUrl->addGet(
    "/colectivos-list",
    [
        "controller" => "colectivos",
        "action" => "all",
    ]
)->setName('listColectivos');

$apiUrl->addPost(
    "/colectivos-search",
    [
        "controller" => "colectivos",
        "action" => "search",
    ]
)->setName('searchColectivo');*/

/***************************************************
***************rutas especialidades*****************
***************************************************/

$apiUrl->addPost(
    "/especialidades-list",
    [
        "controller" => "especialidades",
        "action" => "list",
    ]
)->setName('listEspecialidades');

$apiUrl->addPost(
    "/especialidades-all",
    [
        "controller" => "especialidades",
        "action" => "all",
    ]
)->setName('allEspecialidades');

$apiUrl->addPost(
    "/especialidades-and-serv-all",
    [
        "controller" => "especialidades",
        "action" => "allEspcAndServ",
    ]
)->setName('allEspecialidadesAndServicios');

/***************************************************
*********************rutas citas********************
***************************************************/

$apiUrl->addPost(
    "/citas-list",
    [
        "controller" => "citas",
        "action" => "listAll",
    ]
)->setName('listAllCitas');

$apiUrl->addPost(
    "/generar-claves",
    [
        "controller" => "citas",
        "action" => "genClav",
    ]
)->setName('generarClave');

$apiUrl->addPost(
    "/list-clinicas",
    [
        "controller" => "citas",
        "action" => "buscar",
    ]
)->setName('listCitas');

/***************************************************
******************rutas documentos******************
***************************************************/

$apiUrl->addGet(
    "/docs-list",
    [
        "controller" => "documents",
        "action" => "list",
    ]
)->setName('listDocuments');

/***************************************************
************rutas tipo de servicios*****************
***************************************************/

$apiUrl->addPost(
    "/list-tipo-servicio",
    [
        //"controller" => "tipo-servicio",
        "controller" => "citas",
        "action" => "all",
    ]
)->setName('listTipoServicio');

/***************************************************
************rutas procedimientos medicos************
***************************************************/

$apiUrl->addGet(
    "/procedimientos-medicos-all",
    [
        "controller" => "procedimientos-medicos",
        "action" => "all",
    ]
)->setName('allProcedimientosMedicos');



$apiUrl->addGet(
    "/historial-reporte",
    [
        "controller" => "historial-medico",
        "action" => "search",

    ]
    )->setName('search1ProcedimientosMedicos');



    $apiUrl->addGet(
        "/historial-examenes",
        [
            "controller" => "historial-medico",
            "action" => "searchExamenes",

        ]
        )->setName('search1ProcedimiendtosMedicos');


$apiUrl->addPost(
    "/registrarHistorial",
    [
        "controller" => "historial-medico",
        "action" => "incHistorial",

    ]
    )->setName('search1ProcdedimiendtosMedicos');



    $apiUrl->addPost(
        "/checkTarjeta",
        [
            "controller" => "registro",
            "action" => "checkTarjeta",

        ]
        )->setName('checkTarjeta');


    $apiUrl->addPost(
        "/checkTarjeta",
        [
            "controller" => "registro",
            "action" => "checkTarjeta",

        ]
     )->setName('checkTarjeta');


     $apiUrl->addPost(
         "/checkTerminos",
         [
             "controller" => "registro",
             "action" => "checkTerminos",

         ]
    )->setName('checkTerminos');


    $apiUrl->addPost(
        "/crearCuenta",
        [
            "controller" => "registro",
            "action" => "crearCuenta",

        ]
    )->setName('crearCuenta');


    $apiUrl->addPost(
        "/crearAfiliado",
        [
            "controller" => "registro",
            "action" => "crearAfiliado",

        ]
        )->setName('crearAfiliad');



    $apiUrl->addPost(
        "/crearUsuario",
        [
            "controller" => "registro",
            "action" => "crearUsuario",

        ]
   )->setName('crearUsuario');


   $apiUrl->addPost(
       "/checkToken",
       [
           "controller" => "acttoken",
           "action" => "checktoken",

       ]
       )->setName('checkToken');


   $apiUrl->addPost(
       "/cambiarEstatusCuenta",
       [
           "controller" => "cambiarestatuscuenta",
           "action" => "registro",

       ]
       )->setName('checkTokenq');








$apiUrl->addPost(
    "/actualizarHistorial",
    [
        "controller" => "historial-medico",
        "action" => "actHistorial",

    ]
    )->setName('search1PsrocdedimiendtosMedicos');




    $apiUrl->addPost(
        "/elimExamen",
        [
            "controller" => "historial-medico",
            "action" => "elimExamen",

        ]
        )->setName('search1PsrocdedsimiendtosMedicos');



$apiUrl->addPost(
    "/procedimientos-medicos-list",
    [
        "controller" => "procedimientos-medicos",
        "action" => "list",
    ]
)->setName('listProcedimientosMedicos');

$apiUrl->addPost(
    "/serv-monto",
    [
        "controller" => "procedimientos-medicos",
        "action" => "monto",
    ]
)->setName('monto');


/***************************************************
 ******************citas para videollamadas**********************
 ***************************************************/



$apiUrl->addGet(
    "/especialidad-list",
    [
        "controller" => "citas-video",
        "action" => "listEsp",
    ]
    )->setName('listEspecialidad');



$apiUrl->addGet(
    "/hora-list",
    [
        "controller" => "citas-video",
        "action" => "listHora",
    ]
    )->setName('listEspecialida1d');


$apiUrl->addPost(
    "/incCita",
    [
        "controller" => "citas-video",
        "action" => "incluirCita",
    ]
    )->setName('listEspecialida1d');



$apiUrl->addGet(
    "/cita-list",
    [
        "controller" => "citas-video",
        "action" => "listcitas",
    ]
    )->setName('listEspecialidsa1d');



    $apiUrl->addGet(
        "/citafecha-list",
        [
            "controller" => "citas-video",
            "action" => "listfechacitas",
        ]
        )->setName('listEspecialidsa1d');






/***************************************************
******************rutas viajes**********************
***************************************************/

$apiUrl->addPost(
    "/viajes-list",
    [
        "controller" => "viajes",
        "action" => "listAll",
    ]
)->setName('listAllViajes');

$apiUrl->addPost(
    "/generar-viaje",
    [
        "controller" => "viajes",
        "action" => "genViaje",
    ]
)->setName('genViaje');

/***************************************************
******************rutas Paises**********************
***************************************************/

$apiUrl->addGet(
    "/pais-list",
    [
        "controller" => "pais",
        "action" => "listAll",
    ]
)->setName('listAllPaises');

// Cerrar sesion

$apiUrl->addGet(
    "/user-logaout",
    [
        "controller" => "index",
        "action" => "logaout",
    ]
)->setName('userLogaout');

// Route page not found

$router->notFound(
    [
        "controller" => "index",
        "action"     => "route404",
    ]
);

// Add the group to the router
$router->mount($apiUrl);

return $router;
