<?php namespace App;
/**
 * A lib with utilities for this demo site.
 */

// uses
use \Zentric\View as View;

class Util
{
	/**
	 * adds info about route and code executed
	 */
	static function addInfo($file, $method)
	{
		global $app;
		$section = array_pop( explode('::', $method) );
		$t = View::load(TEMPLATES.'/run-info.html');
		$route = $app->request->current();
		$rt = pathinfo($route['app-template']);
		$route['app-template'] = $rt['basename'];
		$e = array(
			'route' => View::map($route)
			, 'code' => self::getCode($file, $section)
			, 'method' => $method
			, 'uri' => $route['uri']
		);		
		$r[] = View::element($e, $t);		
		$app->response->add (implode('',$r), 'runinfo');
	}

	/**
	 * Read a section of code.
	 * Requires comments styled like ini file sections named same than method.
	 * ```
	 *		// [home]
	 *		function home() {...}
	 * ```
	 */
	static function getCode($file, $section)
	{
		$content = file_get_contents($file);
		$content = str_replace(
			array('// [', chr(9))
			, array('[', '  ')
			, $content
		);
		$sections = View::parse_ini_sections($content);
		$code = highlight_string ('<?php'.$sections[$section], true);
		$code = str_replace('&lt;?php<br />&nbsp;&nbsp;','',$code);
		return $code;
	}

}