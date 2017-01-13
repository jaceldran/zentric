<?php namespace Zentric;
/**
 * Navigation.
 */
class Navigation
{
	/**
	 * Renders a links nav
	 * TO-DO: Review for render a set of elements, not only uris, using a 
	 * a template with patterns form each element type. 
	 */	
	static function render($uris, $template)
	{
		global $app;
		$current = $_SERVER['REQUEST_URI'];

		if (substr($current,-1)==='/') {
			$current = substr($current,0,strlen($current)-1);
		}

		foreach($uris as $key=>$uri) {
			$links[$key] = array (
				'href' => $uri
				, 'text' => $app->locale->say($key)
				, 'style' => ''
			);
			if ($uri===$current) {
				$links[$key]['style'] = 'active'; 
			}
		}
		return View::collection($links, $template);
	}

}