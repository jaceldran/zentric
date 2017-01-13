<?php

/*
 * Default lang
 */

define ('LANG', 'es-ES');

/*
 * URLS and folders
 */

// use local or server config paths and urls
$paths = array (
	'local' => array (
		'root-folder' => 'd:/xampp/htdocs/cdn/zentric'
		, 'app-folder' => 'd:/xampp/htdocs/cdn/zentric/demo'
		, 'home-url' => '/cdn/zentric'
		, 'my-css' => '../myway/css/style.css'
		, 'my-js' => '../myway/js/site.js'
	)
	, 'server' => array(
		'root-folder' => '/home/sonimate/sites/cdn.zentric.es/zentric'
		, 'app-folder' => '/home/sonimate/sites/cdn.zentric.es/zentric/demo'
		, 'home-url' => '/zentric'		
		, 'my-css' => '/myway/css/style.css'
		, 'my-js' => '/myway/js/site.js'
	)
);
if ($_SERVER['HTTP_HOST']==='localhost') {
	$current = $paths['local'];
} else {
	$current = $paths['server'];
}

// main root folder
define ('ROOT', $current['root-folder']);	

// app folder
define ('APP', $current['app-folder']);

// home url
define ('HOME', $current['home-url']);

// myway css and js included in templates/app-default.php
define ('MY_CSS', $current['my-css']);
define ('MY_JS', $current['my-js']);

// full url
$p = strtolower($_SERVER['SERVER_PROTOCOL']);
$p = substr($p, 0, strpos($p,'/'));
define ('HOST', "$p://".$_SERVER['HTTP_HOST'].HOME );

// locale folder
define ('LOCALE', APP . '/locale');

// templates folder
define ('TEMPLATES', APP . '/templates');

// static content folder
define ('CONTENT', APP . '/content');

// storage folder
define ('STORAGE', APP . '/storage');