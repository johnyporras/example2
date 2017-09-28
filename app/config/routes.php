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
    "/add-pasatiempo",
    [
        "action" => "addPasatiempo",
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