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
	"email"=>"Your email isn't correct or allready exists",
	"username"=>"Username allready exists",
	"password"=>"Incorrect password",
	"confirm_password"=>"Different password",
	"teamName"=>"Incorrect team name",
	"new_email" => "Your email isn't correct or allready exists",
	"new_username" => "Username allready exists",
	"emailOrUsername"=>"User not found or allready in team",
	"avatar"=>"Invalid avatar"
];