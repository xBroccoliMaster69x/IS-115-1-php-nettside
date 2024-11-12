<?php

require_once '../core/Router.php';
require_once '../core/Controller.php';


$url = isset($_GET['url']) ? $_GET['url'] : '';


$router = new Router();
$router->route($url);
