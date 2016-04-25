<?php

function autoloader($class)
{
    // verifier s'il existe dans le dossier core s'il existe un fichier
    // du nom de $class.class.php
    // si oui alors include
    $corePath = "core/" . $class . ".php";
    $modelsPath = "models/" . $class . ".php";

    if (file_exists($corePath)) {
        include $corePath;
    } else if (file_exists($modelsPath)) {
        include $modelsPath;
    }
}

spl_autoload_register('autoloader');