<?php

/**
 * Default lang
 */
define ('LANG', 'es-ES');

/**
 * URLS and folders
 */
if ($_SERVER['HTTP_HOST']==='localhost') {	
	$home = '/cdn/zentric';
	$folder = '/demo';
	define ('ENV', 'LOCALHOST');
} else {
	$home = '/zentric';
	$folder = '/demo';
	define ('ENV', 'SERVER');
}
$path = pathinfo(__DIR__);
define ('APP', str_replace('\\','/',$path['dirname']));
if ($folder) { // If access point is at folder, add the folder name 
	define ('HOME', $home.$folder);
} else { // If access point is root, define path in /index.php 
	define ('HOME', $home);
}

/**
 * HOST - full url
 */
$p = strtolower($_SERVER['SERVER_PROTOCOL']);
$p = substr($p, 0, strpos($p,'/'));
define ('HOST', "$p://".$_SERVER['HTTP_HOST'].HOME );

/**
 * locale folder
 */
define ('LOCALE', APP . '/locale');

/**
 * templates folder
 */
define ('TEMPLATES', APP . '/templates');

/**
 * static content folder
 */
define ('CONTENT', APP . '/content');

/**
 * storage folder for type "StorageArray"
 */
define ('STORAGE', APP . '/storage');

/**
 * custom absolute paths (temp)
 * myway css and js included in templates/app-default.php
 */
define ('MY_CSS', '//cdn.zentric.es/myway/css/style.css');
define ('MY_JS', '//cdn.zentric.es/myway/js/site.js');
