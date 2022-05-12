<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
include 'config.php';
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'HEFESTOS',
    'language' => 'es',
    'sourceLanguage' => 'en', //Lenguaje de entrada
    'charset' => 'utf-8',
    'theme' => 'flat',
    
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
   'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.cruge.components.*',
        'application.modules.crugemailer.*',
    ),
    'modules' => array(
        'cruge' => array(
            'tableprefix' => 'cruge_',
            'availableAuthMethods' => array('default'),
            'availableAuthModes' => array('username', 'email'),
            'baseUrl' => $master['domain'],
            'debug' => false,
            'rbacSetupEnabled' => false,
            'allowUserAlways' => false,
            'useEncryptedPassword' => false,
            'hash' => 'md5',
            'afterLoginUrl' => array('/site'),
            'afterLogoutUrl' => null,
            'afterSessionExpiredUrl' => null,
            'loginLayout' => '//layouts/column2',
            'registrationLayout' => '//layouts/column2',
            'activateAccountLayout' => '//layouts/column2',
            'editProfileLayout' => '//layouts/column2',
            'generalUserManagementLayout' => '//layouts/column2',
            'userDescriptionFieldsArray' => array('email'),
        ),
        // uncomment the following to enable the Gii tool
         // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('*', '::1'),
        ),
        
    ),
    // application components
    'components' => array(
        'user' => array(
            'allowAutoLogin' => true,
            'class' => 'application.modules.cruge.components.CrugeWebUser',
            'loginUrl' => array('/cruge/ui/login'),
        ),
         'authManager' => array(
            'class' => 'application.modules.cruge.components.CrugeAuthManager',
        ),
        'crugemailer' => $master['crugemailer'],
         'format' => array(
            'datetimeFormat' => "d M, Y h:m:s a",
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                // array('api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET,OPTIONS'),

            ),
        ),

        // uncomment the following to use a MySQL database
        'db' => $master['database'],
         'excelencia' => array(
            'connectionString' => 'mysql:host=loalhost;dbname=excelencia_mydb',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'class' => 'CDbConnection'          // DO NOT FORGET THIS!
        ),
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
                 array(
                    'class' => 'CEmailLogRoute',
                    'categories' => 'example',
                    'levels' => CLogger::LEVEL_ERROR,
                    'emails' => array('admin@example.com'),
                    'sentFrom' => 'log@example.com',
                    'subject' => 'Error at example.com',
                ),
                array(
                   'class' => 'CFileLogRoute',
                   'levels' => CLogger::LEVEL_WARNING,
                   'logFile' => 'A',
                ), 
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => CLogger::LEVEL_INFO,
                    'logFile' => 'B',
                ), 
                array(
                    'class' => 'CWebLogRoute',
                    'categories' => 'example',
                    'levels' => CLogger::LEVEL_PROFILE,
                    'showInFireBug' => true,
                    'ignoreAjaxInFireBug' => true,
                ), 
                array(
                    'class' => 'CWebLogRoute',
                    'categories' => 'example',
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
        'domain'=>$master['domain'],
        'folder'=>$master['folder'],
        'bussiness'=> $bussiness
        
    ),
);
