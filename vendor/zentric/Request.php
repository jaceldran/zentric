<?php namespace Zentric;
/**
 * Request.
 */
class Request
{
	protected $route;
	protected $routes;
	protected $defaults;
	protected $uri;

	/**
	 * Constructor.
	 * @param array $router configuration.
	 */
	function __construct($router)
	{		
		$this->defaults = $router['defaults'];
		$this->routes = $router['routes'];
		$this->uri =$_SERVER['REQUEST_METHOD']			
			. ' '.substr($_SERVER['REQUEST_URI'], strlen($router['home']));
		$this->route = $this->match();		
	}

	/**
	 * Finds and return current route or null if not found.
	 * @return array|null $route
	 */
	function match()
	{		
		foreach($this->routes as $pattern=>$route) {

			// defaults
			$route = array_merge($this->defaults, $route);
			$route['uri'] = $this->uri;

			// GET method by default 
			if (substr($pattern,0,1)==='/') {
				$pattern = "GET $pattern";
			}
			$route['pattern'] = $pattern;
			$route['params'] = array();
			// if uri match $pattern then there are no placeholders.
			if ($this->uri===$pattern) {
				return $route;
			}

			// check if is a pattern with placeholders and parse.
			$params = array();
			$placeholders = substr_count($pattern, ':');
			if ($placeholders) {
				// get pattern without placeholders
				$corepattern = array_shift(explode(':', $pattern)); 
				$keys = explode('/',substr($pattern,strlen($corepattern)));
				$pattern = $corepattern;				
				
				// if uri starts same as pattern...
				if (substr($this->uri,0,strlen($pattern))===$pattern) {
					
					// ...and is the same number of params.
					$values = explode(':',substr($this->uri, strlen($pattern)));
					if (count($keys)===$placeholders 
						&& count($values)===$placeholders) {

						// create params list.
						foreach($keys as $index=>$key) {
							$params[substr($key,1)] = $values[$index];	
						}
						$route['params'] = $params;

						// return
						return $route;
					}
				}
			}
		}
	}

	/**
	 * Replaces $this->route with a new configuration.	 
	 * @param array $current
	 */
	function setCurrent($current)
	{
		$this->route = $current;
	}

	/**
	 * Gets current route configuration
	 * @return array $this->route 
	 */
	function current()
	{
		return $this->route;
	}

}