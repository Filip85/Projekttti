
<?php
define('BP', '../');

set_include_path(implode(PATH_SEPARATOR, array(
    BP . 'app/model',
    BP. 'app/controller',
    BP. 'app/view'
)));

spl_autoload_register(function ($class) {
    $classPath = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
    if ($file = stream_resolve_include_path($classPath)) {
        include $file;
        return true;
    }
    return false;
});

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

App::start();