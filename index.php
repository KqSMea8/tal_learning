<?php

//统一入口
header('Content-Type: text/html; charset=utf-8');
require('config/config.php');
require(FRAMEWORK_DIR . 'include/bootstrap.php');
require(FRAMEWORK_DIR . 'include/function.php');
require(FRAMEWORK_DIR . 'include/ioc.php');

if (!empty($_GET['debug']))
{
	ini_set('display_errors', 'On');
 	error_reporting( E_ALL );
}

$route = app("lib_router");
$route->run();