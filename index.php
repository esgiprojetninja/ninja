<?php 
ini_set('display_errors', 1);

session_start();

require_once "core/basesql.class.php";
require_once "conf.inc.php";
require_once "models/User.class.php";

function autoloader($class) {
    // verifier s'il existe dans le dossier core s'il existe un fichier
    // du nom de $class.class.php
    // si oui alors include
    $path_core = "core/".$class.".class.php";
    $path_models = "models/".$class.".class.php";

    if (file_exists($path_core)) {
        include $path_core;
    }else if (file_exists($path_models)) {
        include $path_models;
    }
}

spl_autoload_register('autoloader');


$route = routing::setRouting();

if ($route["controller"] != "user" && !User::isConnected()) {
    header("location: ".WEBROOT."user/subscribe");
}

$name_controller = $route['controller']."Controller";
$path_controller = "controllers/".$name_controller.".class.php";
if (file_exists($path_controller)) {
	include $path_controller;
	$controller = new $name_controller();

	$name_action = $route['action']."Action";
	if (method_exists($controller, $name_action)) {
		$controller->$name_action($route['args']);
	}
	else
	{
        http_response_code(404);
        die("404 : L'action n'existe pas");
	}
}
else{
    http_response_code(404);
    die("404 : le controller n'existe pas");
}
