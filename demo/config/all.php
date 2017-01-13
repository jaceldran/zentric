<?php

/*
 * app constants and  settings
 */

require 'constants.php'; // constants

$settings = array (
	'router' => require 'router.php'
	, 'locale' => require 'locale.php'
	, 'navigation' => require 'navigation.php'
);

/*
 * autoload options
 */


// -- using composer

require ROOT . '/vendor/autoload.php';

// -- using custom

/*spl_autoload_register(function($class) {
	$folders = array(
		'App' => __DIR__ . '/app', // <<== replace with app folder 
		'Zentric' => '../vendor/zentric'
	);	
    $pos = strrpos($class, '\\');
	$classname = substr($class, $pos + 1);
	$namespace = substr($class,0,$pos);
	$folder = $folders[$namespace];
	$file = "$folder/$classname.php";
	if (file_exists($file)) {
		include_once $file;
	} else {
		trigger_error ("File not found ($class) $file.<br>");
	}
});*/ 