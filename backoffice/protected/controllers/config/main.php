<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>APP_NAME,
        'theme'=>'swcsNewTheme',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'iloc','cis','infowizard','admin','api','frontuser'=> array('defaultController' => 'home'),'Profile'=>array('defaultController'=>'ViewUpdate'), 'POC','survey','helpdesk', 'dms' ,'feedback','Grievance'=>array('defaultController'=>'grievanceUpdate'),'payment'=>array('defaultController'=>'paymentDetail'),'appeal'=>array('defaultController'=>'generateAppeal'),
		'mis', 
                
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'prepaid',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'ipFilters'=>array($_SERVER['REMOTE_ADDR']),
		),
		
	),

	// application components
	'components'=>array(
		/*'test'=>array(
		        'class'=>'Utility',
		        
		    ),*/
		'user'=>array(
			// enable cookie-based authentication
		//	'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		 'session' => array(
			'autoStart' => true,
                        'cookieParams' => array(
                                'secure' => false,
                                'httponly' => true,
                        ),
                ),
	
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
			'rules'=>array(
				'mis/pendency-report'=>'mis/boApplicationSubmission/pendencyreport',
				'mis'=>'mis/boApplicationSubmission/',
				'mis/growth-report'=>'mis/boApplicationSubmission/growth',
				'mis/Exceldownload'=>'mis/boApplicationSubmission/Exceldownload/',
				'mis/Pdfdownload'=>'mis/boApplicationSubmission/Pdfdownload/',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
