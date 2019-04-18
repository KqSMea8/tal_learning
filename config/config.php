<?php
//设置时区
date_default_timezone_set('Etc/GMT-8');
//文档根目录
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'].'/');
//基础框架目录
define("FRAMEWORK_DIR", ROOT_DIR . 'framework/');
//可写临时缓存目录
define('_CACHE_DIR_', $_SERVER['SINASRV_CACHE_DIR']);

define('BASE_URL', $_SERVER['HTTP_HOST']);
define('CUR_URL',  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

//模板目录
define('TEMPLATE_DIR', 'templates/');
//smarty 编译目录
define('VIEW_COMPILE_DIR', $_SERVER['SINASRV_CACHE_DIR'] . "_templates_c");
//smarty 缓存目录
define('VIEW_CACHE_DIR', $_SERVER['SINASRV_CACHE_DIR'] . "_templates_cache");
//模板后缀
define('TEMPLATE_EXT', '.html');

//默认site
define('DEFAULT_SITE', 'app');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');

define('SITE_NAME', '简版IOC框架');