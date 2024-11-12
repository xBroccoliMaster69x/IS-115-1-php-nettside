<?php

class Router {
    public function route($url) {

        $urlParts = explode('/', $url);

        $controllerName = ucfirst($urlParts[0]) . 'Controller';
        $actionName = isset($urlParts[1]) ? $urlParts[1] : 'index';
        

        if (file_exists('../controllers/' . $controllerName . '.php')) {
            require_once '../controllers/' . $controllerName . '.php';
            $controller = new $controllerName;


            if (method_exists($controller, $actionName)) {

                call_user_func_array([$controller, $actionName], array_slice($urlParts, 2));
            } else {
                echo "Action not found!";
            }
        } else {
            echo "Controller not found!";
        }
    }
}

?>