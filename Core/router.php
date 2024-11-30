<?php 

//håndterer URL routing, forespørsler går til riktige kontrollere metoder 
class Router {
    public function route($url) {

        $urlParts = explode('/', $url); //splitter opp urlen i deler med "/"

        $controllerName = ucfirst($urlParts[0]) . 'Controller'; // plukker ut første delen av url som controllernavn "...Controller" samt første bokstav til stor
        $actionName = isset($urlParts[1]) ? $urlParts[1] : 'index'; // plukker ut neste del som action name (hvis ingen action, index som default)
        echo "Routing to Controller: $controllerName, Action: $actionName<br>"; //debug

        if (file_exists('../controllers/' . $controllerName . '.php')) { //sjekker om controller filen finnes
            require_once '../controllers/' . $controllerName . '.php'; //inkluderer den filen
            $controller = new $controllerName; // gjør den om til ny variabel 
            
            if (method_exists($controller, $actionName)) { //sjekker om action/metoden finnes i kontrolleren
                

                call_user_func_array([$controller, $actionName], array_slice($urlParts, 2)); // dynamisk func, kaller metoden i controlleren, plukker ut index 2 som parametrte i metoden
            } else {
                echo "Action not found!"; //hvis ingen metode funnet
            }
        } else {
            echo "Controller not found!"; //hvis ingen controller funnet 
        }
    }
}

?>
