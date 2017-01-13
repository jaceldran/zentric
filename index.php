<?php namespace App;
/**
 * App settings and start.
 * "index.php" and ".htaccess" files can be moved to root directory 
 * so that app url is http://example.com instead of http://example.com/demo
 */ 

// adjust config/all.php path depending on folder installation/execution. 
// require './config/all.php';		// <<== exec in folder "demo" (or other)  
require './demo/config/all.php';	// <<== exec in root folder

// start app
$app = new \Zentric\App($settings);
$app->start();