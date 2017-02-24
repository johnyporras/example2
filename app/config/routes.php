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

$apiUrl->addGet(
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
)->setName('searchColectivo');

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

$apiUrl->addGet(
    "/especialidades-all",
    [
        "controller" => "especialidades",
        "action" => "all",
    ]
)->setName('allEspecialidades');

/***************************************************
*********************rutas citas********************
***************************************************/

$apiUrl->addGet(
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

$apiUrl->addGet(
    "/list-tipo-servicio",
    [
        "controller" => "tipo-servicio",
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