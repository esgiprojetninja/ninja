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

$errors_msg = [
	"email"=>"Votre email n'est pas correct ou déjà existante",
	"username"=>"Username déja existant",
	"password"=>"Mot de passe incorrect",
	"confirm_password"=>"Mot de passe différend",
	"teamName"=>"Nom d'équipe incorrect",
	"new_email" => "Votre email n'est pas correct ou déjà existante",
	"new_username" => "Username déja existant"
];