<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

define('SITE_DOMAIN','avtospektr.net');
require_once('db.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Интернет-магазин Автоспектр',
	'theme'=>'avtospektr',
	'charset'=>'UTF-8',
	'language'=>'ru',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.helpers.*',
		'application.modules.catalog.models.Items',
		'application.modules.client.models.ClientItems',
		'application.modules.admin.models.AdminItems',
		'application.modules.autoparts.models.Distributors',
		'application.modules.autoparts.models.Basket',
		'application.modules.autoparts.models.PriceGroups',
		'application.modules.autoparts.components.Finance'

	),

	'modules'=>array(
		'catalog'=>array(
		'class'=>'application.modules.catalog.CatalogModule'
		
		),
		'client'=>array(
		'class'=>'application.modules.client.ClientModule'
		
		),
		'admin'=>array(
		'class'=>'application.modules.admin.AdminModule'
		
		),
		'autoparts'=>array(
		'class'=>'application.modules.autoparts.AutopartsModule'
		
		),
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'my_code',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>FALSE
			
        ),
		
		'session' => array(
        'cookieMode' => 'allow',
        'cookieParams' => array(
             'domain' => 'site.ru',
             'httponly' => true,
        ),
    ),
		
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
*/
		'db'=>$config_for_main,
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'cache' => array(
            'class' => 'CFileCache',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error,warning',
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
