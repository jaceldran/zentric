<?php namespace App;

// uses
use \Zentric\View as View;
use \Zentric\Navigation as Nav;

class MyController
{
	// [__construct]
	function __construct()
	{		
		// global app reference
		global $app;
		$this->app = $app;

		// render nav main
		// usually this can be located at some "middleware" action.
		$links = $this->app->settings['navigation']['main'];
		$nav = Nav::render($links, TEMPLATES . '/nav-main.html');
		$this->app->response->add ($nav, 'nav');

		// access sample to any class in "src" folder.
		$default = new DefaultController();
	}

	function error404()
	{
		echo "<h1>error 404 {$_SESSION['error-404']}</h1>";
	}

	// [home]
	function home()
	{
		// adds to response buffer ("main", by default) the content 
		// of static file located at "content/<current-lang>/home.html".
		$this->app->response->add(
			View::load(CONTENT.'/'.LANG.'/home.html')
		);

		// calls method "Util::addInfo" which loads contextual information
		// about current route and method in response buffer "runinfo".
		Util::addInfo(__file__, __method__);

		// sends html response using app-template configured for this route.
		$this->app->response->html();
	}

	// [demos]
	function demos()
	{
		// loads static content		
		$this->app->response->add(
			View::load(CONTENT.'/'.LANG.'/demos.html')
		);

		// puts info about code executed in "runinfo" buffer 
		Util::addInfo(__file__, __method__);

		// sends html response
		$this->app->response->html();
	}

	// [contact]
	function contact()
	{
		// puts  some content in "main" buffer		
		$this->app->response->add('<h1>'.$this->app->locale->say('contact').'</h1>');

		// puts info about code executed in "runinfo" buffer 
		Util::addInfo(__file__, __method__);

		// sends html response
		$this->app->response->html();		
	}

	
}