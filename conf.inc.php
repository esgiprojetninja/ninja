<?php
$explode = explode('/', $_SERVER['SCRIPT_NAME']);
$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$lienbase = $protocol . $_SERVER['HTTP_HOST'] . str_replace(end($explode), '', $_SERVER['SCRIPT_NAME']);
define('WEBROOT', $lienbase);
define("DBHOST","localhost");
define("DBUSER","root");
date_default_timezone_set('Europe/Paris');


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    define("DBPWD","");
} else {
     define("DBPWD","root");
}

define("DBNAME","gauch");
define("SALT", "ABFffds32EOPDx32snklf443dsFDS464");

$errors_msg = [
	"email"=>"Votre email n'est pas correct ou existe déjà",
	"username"=>"Ce pseudo existe déjà",
	"password"=>"Mot de passe erroné",
	"confirm_password"=>"Vos mots de passe ne correspondent pas",
	"teamName"=>"Ce nom de team est invalide ou existe déjà",
	"new_email" => "Votre email n'est pas correct ou existe déjà",
	"new_username" => "Ce pseudo existe déjà",
    "username_doesnt_exists" => "Ce pseudo n'existe pas",
	"emailOrUsername"=>"User not found, allready in team or allready invited",
	"avatar"=>"Votre avatar n'est pas valide",
	"sports"=>"ERROR 404 SPORT NOT FOUND",
	"new_teamName"=>"Incorrect team name or allready exists",
	"email_exist"=>"Email introuvable",
  	"date_format"=>"Veuillez respecter ce format de date => jour/mois/année",
  	"time_format" => "Veuillez respecter ce format d'heure => heure:minute"
];
