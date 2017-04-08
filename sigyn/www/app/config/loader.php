<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Sigyn\Models' => APP_PATH . '/common/models/',
    'Sigyn\Library'        => APP_PATH . '/common/library/',

]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Sigyn\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Sigyn\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->registerDirs(
    [
        //$config->application->controllersDir,
        //$config->application->modelsDir,
        $config->application->pluginsDir,
        //$config->application->libraryDir
    ]
);

$loader->register();
