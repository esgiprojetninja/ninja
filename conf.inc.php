<?php 
$explode = explode('/', $_SERVER['SCRIPT_NAME']);
$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$lienbase = $protocol . $_SERVER['HTTP_HOST'] . str_replace(end($explode), '', $_SERVER['SCRIPT_NAME']);
define('WEBROOT', $lienbase);
define("DBHOST","localhost");
define("DBUSER","root");


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    define("DBPWD","");
} else {
     define("DBPWD","root");
}



define("DBNAME","ninja_db");
DEFINE("SALT", "ABFffds32EOPDx32snklf443dsFDS464");

<<<<<<< HEAD
$errors_msg = [
	"email"=>"Votre email n'est pas correct",
	"username"=>"Votre username n'est pas correct",
=======

$errors_msg = [
	"email"=>"Votre email n'est pas correct ou déjà existante",
	"username"=>"Username déja existant",
	"password"=>"Mot de passe incorrect",
	"confirm_password"=>"Mot de passe différend",
	"teamName"=>"Nom d'équipe incorrect"
>>>>>>> 8f901c177c50222285b0e9d36c2779aecce19d0e
];