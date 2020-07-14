<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Hefestos',
    'language' => 'es_es',
    // 'timeZone' => 'America/Caracas',
    'sourceLanguage' => 'es',
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
            'baseUrl' => 'https://kingdeportes.com/hefestos',
            'debug' => true,
            'rbacSetupEnabled' => true,
            'allowUserAlways' => false,
            'useEncryptedPassword' => false,
            'hash' => 'md5',
            'afterLoginUrl' => null,
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
            'ipFilters' => array('190.97.233.2', '::1'),
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
        'crugemailer' => array(
            'class' => 'application.modules.crugemailer.CrugeSwiftMailer',
            'mailfrom' => 'soporte.kingdeportes@gmail.com',
            'subjectprefix' => 'Notificacion - ',
            'transport' => 'gmail',
            'gmailAcount' => "soporte.kingdeportes@gmail.com",
            'gmailPassword' => "Cristian804!",       
            // 'debug' => true,
        ),
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
            ),
        ),

        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=hefestos',
            'emulatePrepare' => true,
            'username' => 'king_hefestos',
            'password' => 'c@D%%8mj5Og@',
            'charset' => 'utf8',
        ),
         'excelencia' => array(
            'connectionString' => 'mysql:host=localhost;dbname=excelencia_mydb',
            'emulatePrepare' => true,
            'username' => 'king_hefestos',
            'password' => 'c@D%%8mj5Og@',
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
    ),
);
