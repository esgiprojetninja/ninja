<?php
/* Ca marche pas sinon 100% certified nicoto */
$explode = explode('/',$_SERVER['SCRIPT_NAME']);
$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$lienbase = $protocol . $_SERVER['HTTP_HOST'] . str_replace(end($explode), '', $_SERVER['SCRIPT_NAME']);

define('WEBROOT', $lienbase);
define('APP', WEBROOT . 'app/');

define("DBHOST","localhost");
define("DBUSER","root");
define("DBPWD","root");
define("DBNAME","ninja_db");

DEFINE("SALT", "ABFffds32EOPDx32snklf443dsFDS464");
