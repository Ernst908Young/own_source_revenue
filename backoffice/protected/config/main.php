<?php

if (!isset($_SESSION)) {
    session_start();
}

$theme = 'investor_theme';
if(isset($_SESSION['role_id']) && $_SESSION['role_id']==63){
       $theme = 'investor_theme';
    }

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => APP_NAME,    
    'theme' => $theme,
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',       
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
       // 'GrievanceNew',
        // 'ticket',
         'iloc', 'cis', 'infowizard', 'admin', 'api', 'mobileapi','dss',
        'frontuser' => array('defaultController' => 'home'), 
        'Profile' => array('defaultController' => 'ViewUpdate'),
        'POC', 'survey', 'helpdesk', 'dms', 'messages', 'query', 'feedback',
        //'Grievance' => array('defaultController' => 'grievanceUpdate'),
        'payment' => array('defaultController' => 'paymentDetail'),
        'appeal' => array('defaultController' => 'generateAppeal'),
        'mis', 
        'ticketing' => array('defaultController' => 'default'),
        'queries' => array('defaultController' => 'default'),
         'grievance' => array('defaultController' => 'default'),
        'investor' => array('defaultController' => 'home'),
        'infowizardtwo', 
        'profile' => array('defaultController' => 'default'),
        'cashier' => array('defaultController' => 'default'), 'misreports',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'prepaidadadsdadasd1313',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            //'ipFilters' => array($_SERVER['REMOTE_ADDR']),
        ),
    ),
    'components' => array(
         /*'request'=>array(
    'enableCsrfValidation'=>true,
    ),*/
        /* 'Smtpmail'=>array(
          'Mailer' => 'smtp',
          'Host' => 'smtp.gmail.com',
          'Port' => 465,
          'SMTPSecure' => 'ssl',
          'SMTPAuth' => true,
          'Username' => 'caipodummy@gmail.com',
          'Password' => 'caipo@123',

          'class'=>'application.extensions.smtpmail.PHPMailer',
          'Host'=>"smtp.gmail.com",
          'Username'=>'',
          'Password'=>'',
          'Mailer'=>'smtp',
          'Port'=>26,
          'SMTPAuth'=>true,
          ), */



        /* 'test'=>array(
          'class'=>'Utility',

          ), */
        'user' => array(
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
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'mis/pendency-report' => 'mis/boApplicationSubmission/pendencyreport',
                'mis' => 'mis/boApplicationSubmission/',
                'mis/growth-report' => 'mis/boApplicationSubmission/growth',
                'mis/Exceldownload' => 'mis/boApplicationSubmission/Exceldownload/',
                'mis/Pdfdownload' => 'mis/boApplicationSubmission/Pdfdownload/',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
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
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        //'verifier_dashboard' => 'form_builder_verifier',
        //'approver_dashboard' => 'form_builder_approver',
        //'support_dashboard' => 'support_ticket',
        //'admin_dashboard' => 'admin_dashboard',
        // NEw Template
        'verifier_dashboard' => '/default/new/form_builder_verifier',
        'approver_dashboard' => '/default/new/form_builder_approver',
        'support_dashboard' => '/default/new/support_ticket',
        'admin_dashboard' => '/default/new/admin_dashboard',
        'cashier_dashboard' => '/default/new/cashier_dashboard',
        'acountant_dashboard' => '/default/new/accountant_dashboard',
         'registrar_dashboard' => '/default/new/registrar_dashboard',
        'CR_IN' => '50000', // company registration initial value
        'SR_IN' => '1600', // Society registration initial value
        'CHR_IN' => '1600', // Charity & Charity board registration initial value
        'BR_IN' => '79000', // Business registration initial value
        'LPR_IN' => '60', // Limited Partnership firm registration initial value
    ),
);
