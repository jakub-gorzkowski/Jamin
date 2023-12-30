<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/ContentController.php';

class Routing {
    public static $routes;

    public static function get($url, $view) {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view) {
        self::$routes[$url] = $view;
    }

    public static function run($url) {
        $action = explode("/", $url)[0];
        
        if ($action == null) {
            $action = 'home';
            header('Location: /home');
        } 
        
        if (!array_key_exists($action, self::$routes)) {
            $action = 'notfound';
            header('Location: /notfound');
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'home';

        $object -> $action();
    }
}

?>