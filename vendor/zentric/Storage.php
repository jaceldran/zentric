<?php namespace Zentric;
/*
 * Wrapper for data storage. 
 */
class Storage
{
	/*
	 * Driver.
	 */
	protected $driver;

	/*
	 * Sets driver storage like "StorageMySQL", "StorageArray"...
	 * Asumes that driver files are in the samen folder.
	 * @param array $settings for driver like type, user, pass...
	 */
	function __construct($settings=array())
	{
		$driver = 'Storage' . $settings['driver'];
		$path = __DIR__ . "/$driver.php";
		include_once $path;
		$driver = __NAMESPACE__ . "\\$driver";
		$this->driver = new $driver($settings);
	}
	
	/*
	 * Sends calls to driver and returs the result.
	 */
	function __call($method, $args)
	{
		if (isset($this->driver)) {
			return call_user_func_array (
				array($this->driver, $method)
				, $args
			);
		}
	}

}