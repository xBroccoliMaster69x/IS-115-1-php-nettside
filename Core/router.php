<?php 

//håndterer URL routing, forespørsler går til riktige kontrollere metoder 
class Router {
    public function route($url) {

        $urlParts = explode('/', $url); //splitter opp urlen på "/"

        $controllerName = ucfirst($urlParts[0]) . 'Controller'; //capitaliserer første bokstar, og setter den sammen med controller
        $actionName = isset($urlParts[1]) ? $urlParts[1] : 'index'; //lagrer $actionName som $urlParts[1], om denne finnes settes den til index hvilket kaller index() metoden fra controlleren nedenfor
        

        if (file_exists('../controllers/' . $controllerName . '.php')) { //lager controller objekt som samsvarer med $controllerName variablen dersom en finnes
            require_once '../controllers/' . $controllerName . '.php';
            $controller = new $controllerName;


             // Enforce access control for admin routes
             if ($controllerName === 'AdminController') {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start(); // Start session if it hasn't started already
                }
                if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
                    // Redirect to login if not logged in or not an admin
                    header("Location: /phpnettside/public/index.php?url=User/login");
                    exit;
                }
            }

            if (method_exists($controller, $actionName)) { //dersom metoden finnes i klassen som er kontrolleren da kalles denne, dersom subpage ikke er spesifisert er dette index() metoden

                call_user_func_array([$controller, $actionName], array_slice($urlParts, 2)); //caller $actionname fra controlleren, og passerer argumenter til denne utfra url.
            } else {
                echo "Action not found!"; //hvis ingen metode funnet
            }
        } else {
            echo "Controller not found!"; //hvis ingen controller funnet 
        }
    }
}

?>
