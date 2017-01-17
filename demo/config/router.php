<?php
/**
 * Router configuration
 */
 return array (

	 // home url
	 'home' => HOME

	 // default attrs apply to all routes except if overwritten
	 , 'defaults' => array (
		// default app-template used for html responses 
		'app-template' => TEMPLATES.'/app-default.php'
		// if you want a default controller, declare "class" here 
		// and "method" in desired routes.
		, 'class' => 'App\MyController'
	 )

	 // routes registry  [<method>] <pattern> => <config[]>
	 , 'routes' => array (

		 // app
		'/' => array ('method'=>'home')
		, '/demos' => array ('method'=>'demos')
		, '/contact' => array ('method'=>'contact')

		// errors
		, '/error/404' => array('method'=>'error404')
	 )

 );