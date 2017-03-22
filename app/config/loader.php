<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->validationsDir,
	    $config->application->libraryDir,
    ]
);

/*$loader->registerClasses([
    'JWT' => APP_PATH.'/library/JWT.php'
]);*/

$loader->register();