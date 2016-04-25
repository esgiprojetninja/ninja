<?php

$explode = explode('/', $_SERVER['SCRIPT_NAME']);
$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$lienbase = $protocol . $_SERVER['HTTP_HOST'] . str_replace(end($explode), '', $_SERVER['SCRIPT_NAME']);

define('WEBROOT', $lienbase);
define('APP', WEBROOT . 'app/');
define('SALT', 'ABFffds32EOPDx32snklf443dsFDS464');