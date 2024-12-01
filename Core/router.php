<?php 

//håndterer URL routing, forespørsler går til riktige kontrollere metoder 
class Router {
    public function route($url) {

<<<<<<< HEAD
        $urlParts = explode('/', $url); //splitter opp urlen i deler med "/"

        $controllerName = ucfirst($urlParts[0]) . 'Controller'; // plukker ut første delen av url som controllernavn "...Controller" samt første bokstav til stor
        $actionName = isset($urlParts[1]) ? $urlParts[1] : 'index'; // plukker ut neste del som action name (hvis ingen action, index som default)
        echo "Routing to Controller: $controllerName, Action: $actionName<br>"; //debug

        if (file_exists('../controllers/' . $controllerName . '.php')) { //sjekker om controller filen finnes
            require_once '../controllers/' . $controllerName . '.php'; //inkluderer den filen
            $controller = new $controllerName; // gjør den om til ny variabel 
            
            if (method_exists($controller, $actionName)) { //sjekker om action/metoden finnes i kontrolleren
                

                call_user_func_array([$controller, $actionName], array_slice($urlParts, 2)); // dynamisk func, kaller metoden i controlleren, plukker ut index 2 som parametrte i metoden
=======
        $urlParts = explode('/', $url); //splitter opp urlen på "/"

        $controllerName = ucfirst($urlParts[0]) . 'Controller'; //capitaliserer første bokstar, og setter den sammen med controller
        $actionName = isset($urlParts[1]) ? $urlParts[1] : 'index'; //lagrer $actionName som $urlParts[1], om denne finnes settes den til index hvilket kaller index() metoden fra controlleren nedenfor
        

        if (file_exists('../controllers/' . $controllerName . '.php')) { //lager controller objekt som samsvarer med $controllerName variablen dersom en finnes
            require_once '../controllers/' . $controllerName . '.php';
            $controller = new $controllerName;


            if (method_exists($controller, $actionName)) { //dersom metoden finnes i klassen som er kontrolleren da kalles denne, dersom subpage ikke er spesifisert er dette index() metoden

                call_user_func_array([$controller, $actionName], array_slice($urlParts, 2)); //caller $actionname fra controlleren, og passerer argumenter til denne utfra url.
>>>>>>> 06bfc943c7500c868494991ced202e24c896d362
            } else {
                echo "Action not found!"; //hvis ingen metode funnet
            }
        } else {
            echo "Controller not found!"; //hvis ingen controller funnet 
        }
    }
}

?>
