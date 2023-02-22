<?php 
require("constants.php");
ini_set('short_open_tag', '1');
// change the following paths if necessary
//$yii='/var/www/yiii/framework/yii.php';
$yii='../yiii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
if(ENV=='DEV'){
	error_reporting(E_ALL); 
	ini_set('display_errors', 0);
}
else{
	error_reporting(0); 
	ini_set('display_errors', 0);	
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',0);

require_once($yii);
Yii::createWebApplication($config)->run();
