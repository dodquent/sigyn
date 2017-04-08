<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => getenv("DATABASE_HOST"),
        'username'    => getenv("DATABASE_USER"),
        'password'    => getenv("DATABASE_PASS"),
        'dbname'      => getenv("DATABASE_NAME"),
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'websocketPort' => 8088,

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => '/',
    ]


]);
