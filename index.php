<?php

session_start();

require 'configurations/configurations.php';
require 'configurations/database.php';
require 'core/autoload.php';

$route = routing::setRouting();

$controllerName = "views";
$controllerPath = "controllers/" . $controllerName . ".php";
if (file_exists($controllerPath)) {
    include $controllerPath;
    $controller = new $controllerName();
    $actionName = $route['action'];
    if (method_exists($controller, $actionName)) {
        $controller->$actionName($route['args']);
    } else {
        die("L'action n'existe pas");
    }
} else {
    die("404, le controller n'existe pas");
}
