<?php
/*
 * Modified: preppend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Postgresql',
        'host'        => 'atiempo.czz0a4kakmcn.us-east-2.rds.amazonaws.com',
        'username'    => 'atiempoaws',
        'password'    => 'AT2017Amazon**',
        'dbname'      => 'atiempo_anet',
        'schema'      => 'atiempo_prod'
        //'charset'     => 'utf8',
    ],
    'mail' => [
        'fromName' => 'Corporacion Atiempo',
        'fromEmail' => 'no-reply@corporacionatiempo.com',
        'smtp' => [
            'server'	=> 'cloud1013.hostgator.com',
            'port' 		=> 465,
            'security' => 'ssl',
            'username' => 'no-reply@corporacionatiempo.com',
            'password' => ',v*rK0-61!;3',
        ]
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'validationsDir' => APP_PATH . '/validations/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/Atiempo-API/',
        'publicUrl'      => '127.0.0.1/Atiempo-API',
    ]
]);
