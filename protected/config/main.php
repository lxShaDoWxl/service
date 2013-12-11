<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'and',
    'language' => 'ru',
	'sourceLanguage' => 'ru',
	// preloading 'log' component
	'preload'=>array('debug'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.admin.models.*',
        'ext.giix-components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
        'admin',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'21010506',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('10.0.0.55','::1'),
            'generatorPaths' => array(
                'ext.giix-core', // giix generators
            ),
		),

	),

	// application components
	'components'=>array(
		'authManager' => array(
			// Будем использовать свой менеджер авторизации
			'class' => 'PhpAuthManager',
			// Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
			'defaultRoles' => array('0'),
		),
//        'clientScript' => array(
//            'class' => 'application.extensions.NLSClientScript',
//        ),
           'user'=>array(
				'class' => 'WebUser',
					// enable cookie-based authentication
				'allowAutoLogin'=>true,
		),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'debug' => array(
            'class' => 'ext.yii2-debug.Yii2Debug',
            'enabled'=>true,
            'allowedIPs'=>array('10.0.0.55', '::1')
        ),
        //Yii2Debug::dump($category);
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=instinct_and',
			'emulatePrepare' => true,
			'username' => 'insti_androot',
			'password' => '123456',
			'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
            'routes' => array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                ),
              /*  array(
                    'class' => 'ext.phpconsole.PhpConsoleYiiExtension',
                    'handleErrors' => true,
                    'handleExceptions' => true,
                    'basePathToStrip' => dirname($_SERVER['DOCUMENT_ROOT'])
                )
*/
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),

			),*/
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);