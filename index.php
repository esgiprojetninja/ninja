<?php 
session_start();

require_once "conf.inc.php";
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

$name_controller = $route['c']."Controller";
$path_controller = "controllers/".$name_controller.".class.php";
if (file_exists($path_controller)) {
	include $path_controller;
	$controller = new $name_controller();

	$name_action = $route['a']."Action";
	if (method_exists($controller, $name_action)) {
		$controller->$name_action($route['args']);
	}
	else
	{
		die("L'action n'existe pas");
	}
}
else{
	die("404, le controller n'existe pas");
}