<?php namespace App;
/**
 * App settings and start.
 * Files "index.php" and ".htaccess" configure the access point to apps.
 *
 * Both files can be located at root directory so that app url 
 * is http://example.com instead of http://example.com/<app-folder>
 * 
 * But, also each app can be stored at one folder containing custom 
 * "index.php" and ".htaccess" so that access url is 
 * http://example.com/<app-folder>. This way, several apps can share the 
 * same installation of "vendor/zentric" core and component libraries.
 */ 

// Read $settings declared at config/all.php.
// If folder is the access point for app(s) http://example.com/<app-folder>
// then path to config can omit the app-folder and this file index.php should
// be located at the app folder, beside the corresponding .htaccess. 
require './config/all.php';

// If access point for app is root http://example.com/
// path to config must include the app-folder.
// require './app-demo/config/all.php';

// start app with $settings
$app = new \Zentric\App($settings);
$app->start();