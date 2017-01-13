<?php namespace Zentric;
/*
 * View.
 */
class View
{
	/*
	* Renders a object ($data) using a $template
	* @param array $object Associative array.
	* @param string $template.
	* @return string object rendered.
	*/
	static function element($object, $template)
	{
		$search = array();
		$replace = array();
		foreach($object as $key=>$value) {
			if (!is_scalar($value)) continue;
			$search[] = '%'.strtolower($key).'%';
			$replace[] = $value;
		}	
		return str_replace($search, $replace, $template);
	}

	/*
	* Renders a collection of elements ($data) using $template.
	* @param array $data.
	* @param array|string $template, asumes sections INI|ELM|END.
	* @param array $marks Marks that apply the wole document.
	*/
	static function collection($data, $template, $marks=array()) {

		if (is_string($template)) {
			$template = self::parse_ini_sections($template);
		}

		$r[] = $template['INI'];
		foreach($data as $index=>$elm) {
			$elm['index'] = $index;			// en base 0
			$elm['position'] = $index+1; 	// en base 1
			$r[] = self::element($elm, $template['ELM']);
		}
		$r[] = $template['END'];

		$view = implode('', $r);
		$view = self::element($marks, $view);

		return $view;
	}

	/*
	* Parses a ini file  but content goes in sections instead of variables. 
	* @param string $path full file path.
	* @return array Associative list [section] => content. 
	*/
	static function parse_ini_sections($source)
	{
		// read or parse source
		$ispath = ! strpos($source, chr(10));
		if ($ispath) {
			if (!file_exists($source)) {return;}			
			$content = file($source);
		} else {
			$content = explode(chr(10), $source);
		}

		// if no initial section, content goes to "none" section.
		$parse = array();
		$section = 'none';
		$parse[$section] = '';

		// process lines
		foreach($content as $line) {
			$trim = trim($line);
			if (empty($trim)) continue;
			if (substr($trim, 0, 1)==='[') {
				$section = str_replace(array('[',']'),'',$trim);
				$parse[$section] = '';
			} else {
				$parse[$section]  .=  "\n" . $line;
			}
		}
		return $parse;
	}

	/*
	 * reads a template file (or any)
	 */
	static function load($path)
	{
		if (!file_exists($path)) {return "not found $path";}
		return file_get_contents($path);
	}

	/*
	* Renders all arguments in "print_r" format, usually for debug purposes.
	* @param mixed arguments
	* @return string
	*/
	static function map()
	{	
		$args = func_get_args();
		foreach($args as $arg) {
			$map[] = '<pre>' . print_r($arg, true) . '</pre>';
		} 
		return implode('',$map);
	}

}