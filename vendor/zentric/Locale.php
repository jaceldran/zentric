<?php namespace Zentric;
/**
 * Locale. Multilang support.
 */
class Locale
{	
	protected $data = array();
	protected $lang;
	protected $path;

	/**
	 * Constructor.
	 * @param array $settings.
	 */
	function __construct($settings=array())
	{
		$this->lang = $settings['lang'];
		$this->path = $settings['path'].'/'.$settings['lang'];
		$this->defaults = $settings['defaults'];
		foreach($this->defaults as $key) {
			$this->load($key);
		}
	}
	
	/**
	 * Returns the translation for $key or an acronym if not found.
	 * @param string $key 
	 * @param boolean $acronym
	 */
	public function say($key, $acronym=true)
	{	
		if (isset($this->data[$key])) {
			return $this->data[$key];
		} else {
			if ($acronym) {
				return '<acronym title="no-key-locale">'.$key.'</acronym>'; 
			} else {
				return $key;
			}
		}
	}


	/**
	 * Load dictionary files.
	 * Requires a defined path in $this->path.
	 * Every argument is a key
	 */
	public function load()
	{		
		$keys = func_get_args();
		if (empty($keys)) {
			return;
		}
		foreach($keys as $key) {			
			$file = "{$this->path}/$key.php";
			if (file_exists($file)) {
				$locale = include $file;
				$this->data = array_merge($this->data, $locale);
			} else {
				trigger_error("File not found '$file'");
			}
		}
	}

	/**
	 * Returns all keys in current dictionary.
	 * @param string $prefix optional prefix added to every key.
	 */
	function all($prefix=null)
	{
		$data = $this->data;
		if (!empty($prefix)) {
			$data = array();
			array_walk($this->data,	function($value, $index) use ($prefix, &$data) {
				$data[$prefix.$index] = $value;
			});
		}
		return $data;
	}

}