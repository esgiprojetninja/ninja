<?php

session_start();

require 'configurations/configurations.php';
require 'configurations/database.php';
require 'core/autoload.php';

$route = routing::setRouting();