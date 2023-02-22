<?php

require("constants.php");
$yii='../yiii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
error_reporting(E_ALL); 
ini_set('display_errors', 0);


// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',DEBUG);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',0);

require_once($yii);
Yii::createWebApplication($config)->run(); 
