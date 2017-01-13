<?php namespace Zentric;
/*
 * Response.
 */
class Response
{
	protected $template;
	protected $buffers = array();

	/*
	 * Sets a response template.
	 * @param string $path fullpath to template file.
	 */
	function setTemplate($path)
	{	
		$this->template = $path;
	}

	/*
	 * Adds content in an output buffer.
	 * @param string $content.
	 * @param string $buffer.
	 */
	function add($content, $buffer='main')
	{			
		$this->buffers[$buffer][] = $content;
	}

	/*
	 * Renders response content using template and buffers.
	 * @return string response body.
	 */
	function render()
	{
		ob_start();
		$this->sending = 1;
		include $this->template;
		$content = ob_get_contents();
		ob_end_clean();
		$this->sending = 0;
		return $content;
	}

	/*
	 * Sends $data as a JSON response.
	 * @param array $data.
	 */
	function json($data=array())
	{
		$this->headers('json');	
		echo json_encode($data);
	}

	/*
	 * Sends content generated by render() as a HTML response.
	 */
	function html()
	{
		$this->headers('html');	
		echo $this->render();
	}

	/*
	 * Sends content generated by render() as a TEXT response.
	 */
	function text()
	{
		$this->headers('text');	
		echo $this->render();
	}

	/*
	 * Redirect.
	 * @param string $location.
	 */
	function redirect($location)
	{
		header("Location: $location");
		die();
	}

	/*
	 * Set headers by content type.
	 * @param string $type => html|json|text
	 */
	function headers($type='text')
	{	
		// TODO: Determinar mediante configuración si se permite o no
		// la respuesta a peticiones remotas. Por ahora sí, siempre.
		$cors = '*';		
		header("Access-Control-Allow-Origin: $cors");
		header('Access-Control-Allow-Credentials: true');	
		
		switch($type) {
			case 'html':
				header('Content-Type:text/html; Charset=UTF-8');
				break;
			case 'json':
				header('Content-Type:application/javascript; Charset=UTF-8');
				break;
			case 'text':
				header('Content-Type:text/plain; Charset=UTF-8');	
				break;
		}
	}

	/*
	 * Gets the content of any buffer as a call method.
	 *
	 * Example: 	
	 *	response->add("This is the title", "title");
	 *	response->title(); // <<== returns "This is the title"
	 * 
	 * @param string $key Invoked method used to search buffer.
	 * @param array $args	Rest of arguments (ignored).
	 */
	function __call($key, $args)
	{
		if (isset($this->buffers[$key])) {
			$content = implode("\n", $this->buffers[$key]);
			if ($this->sending) {
				echo $content;
			} else {
				return $content;
			}
		}
	}

}