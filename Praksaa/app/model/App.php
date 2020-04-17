<?php

final class App {
    public static function start() {
        include('../app/config.php');
        //$path = $_SERVER['REQUEST_URI'];
        $path = Request::pathInfo();

        $path = trim($path, '/');
        $parts = explode('/', $path);

        if(!isset($parts[0]) || empty($parts[0])) {
            $controller = 'Index';
        }
        else {
            $controller = ucfirst(strtolower($parts[0]));
        }

        $controller .= 'Controller';

        if(!isset($parts[1]) || empty($parts[1])) {
            $action = 'index';
        }
        else {
            $action = strtolower($parts[1]);
        }

        if(class_exists($controller) && method_exists($controller, $action)) {
            $IController = new $controller;
            $IController->$action();
        }

    }

    public static function config() {
        return include('../app/config.php');
    }
}