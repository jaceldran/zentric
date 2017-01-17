<?php

/**
 * app constants and  settings
 */
require 'constants.php';
$settings = array ( // args for Zentric\App
	'router' => require 'router.php'
	, 'locale' => require 'locale.php'
	, 'navigation' => require 'navigation.php'
);

/**
 * using composer autoload
 */
require '../vendor/autoload.php';

/**
 * using custom autoload
 */
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
