<?php namespace Zentric;
/**
 * Application
 */
class App
{	
	/**
	 * Constructor.
	 * @param array $settings router, locale, navigation...
	 */
	function __construct($settings)
	{
		session_start();
		$this->settings = $settings;
		$this->locale = new Locale($settings['locale']);
		$this->request = new Request($settings['router']);
		$this->response = new Response();		
	}

	/**
	 * Finds current route configuration.
	 * Sets response templates, if needed.
	 * Invokes method attached to route.
	 */
	function start()
	{
		if ($current = $this->request->current()) {

			// set response template, if provided
			if (!empty($current['app-template'])) {				
				$this->response->setTemplate($current['app-template']);
			}

			// parse template-data, if provided.
			if (!empty($current['data-template'])) {
				$current['data-template'] = 
					parse_ini_sections($current['data-template']);
				$this->request->setCurrent($current);
			}

			// invoke method attached to route with params.
			$class = $current['class'];
			$method = $current['method'];
			$params = $current['params'];
			$object = new $class();
			call_user_func_array(array($object, $method),$params);

		} else {
			//trigger_error('<h1>404 no encontrado</h1>');
			$uri = $_SERVER['REQUEST_URI'];
			$_SESSION['error-404'] = $uri;			
			$this->response->redirect(
				$this->settings['router']['home'] . '/error/404'
			);
						
		}
	}
}