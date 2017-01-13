<?php namespace Zentric;
/*
 * For low volume data. Data is stored in disk files, not database.
 * Pensado para un contenedor de elementos que se almacenan el el data.
 */ 
class StorageArray
{
	protected $key;
	protected $folder;
	protected $file;

	/*
	 * Constructor.
	 * @param array $settings (key=>identifier, folder=>storage path)
	 */
	function __construct($settings=array())
	{
		$this->key = $settings['key'];
		$this->folder = $settings['folder']; 
		$this->file = $this->path();
	}

	/*
	 * Compute fullpath for identifier $key.
	 * @param string $key
	 */
	function path($key=null)
	{
		if (empty($key)) $key = $this->key;
		return $this->folder."/$key.php";
	}
	
	/** storage files operations **/

	/*
	 * Create a new storage file.
	 */
	function create($values=array(), $file=null)
	{
		if (empty($file)) {
			$file = $this->file;
		}
		if (file_exists($file)) {
			return;
		}		
		$content = array (
			'file' => basename($this->file)
			, 'created' => date('Y-m-d H:i:s')
			, 'updated' => null
		);
		$values = array_merge($content, $values);
		$created = $this->update($values, $file);
		return $created;
	}

	/*
	 * Read a file content.
	 * @param string $file fullpath. 
	 */
	function read($file=null)
	{
		if (empty($file)) {
			$file = $this->file;
		}
		$content = array();
		if (file_exists($file)) {
			$content = include $file;
		}		
		return $content;		
	}

	/*
	 * Update.
	 * @param array $values Attributes and values list.
	 * @param string $file Fullpath to storage file.
	 * @return boolean Operation result.
	 */
	function update($values, $file=null)
	{
		if (empty($file)) {
			$file = $this->file;
		}
		$values = array_merge($this->read($file), $values);
		$content = '<?php return ' . var_export($values, true) . ';';
		$updated = file_put_contents($file, $content);
		return $updated;
	}

	/** data content operations **/

	/*
	 * Registers a value for a attribute in current storage.
	 * Registra un valor en un atributo del almacenamiento actual.
	 * @param string $key Key de registro.
	 * @param mixed $value Atributos y valores del elemento.
	 * @param string $attr Atributo donde se añade el elemento.
	 * @return boolean Resultado de la operación.
	 */
	function register($key, $value, $attr='data', $file=null)
	{
		$content = $this->read($file);
		if (empty($content[$attr])) {
			$content[$attr] = array();
		}
		$content[$attr][$key] = $value;
		return $this->update($content);
	}

	/*
	 * Adds a value for a attribute in current storage.
	 * Añade un valor a un atributo del almacenamiento actual.
	 * @param array $elm Atributos y valores del elemento.
	 * @param string $attr Atributo donde se añade el elemento.
	 * @return boolean Resultado de la operación.
	 */
	function add($value, $attr='data', $file=null)
	{
		$content = $this->read($file);
		if (empty($content[$attr])) {
			$content[$attr] = array();
		}
		$content[$attr][] = $value;
		return $this->update($content);
	}

	/*
	 * Reads the element located at $index in current storage.
	 * Lee un elemento del almacenamiento actual.
	 * @param numeric $index
	 */
	function get($index)
	{
		$content = $this->read();
		$elm = $content['data'][$index];
		$elm['index'] = $index;		
		return $elm;		
	}

	/*
	 * Updates merging, not replacing, the element located at $index in current storage. 
	 * Actualiza un elemento del almacenamiento actual.
	 * @param numeric $index
	 * @param array $values Attributes and values list.
	 */
	function merge($index, $values)
	{
		$content = $this->read();
		$elm = $content['data'][$index];
		$content['data'][$index] = array_merge($elm, $values);
		return $this->update($content);		
	}

	/*
	 * Elimina  un elemento del almacenamiento actual.
	 * @param numeric $index
	 *	Posición en base 0 del elemento.
	 */
	function remove($index)
	{
		$content = $this->read();
		if ($index==='*') {
			$content['data'] = array();
		} else {
			unset($content['data'][$index]);
		}				
		return $this->update($content);
	}


	/*
	 * Finds a element by attribute value.
	 * Requires a "file-by-attr-" index file.
	 * Localiza un elemento por un valor de atributo.
	 * Requiere que exista el correspondiente archivo de índice.
	 * @param string $attr.
	 * @param string $value. 
	 */
	function find($attr, $value)
	{
		$content = $this->read();
		$key = "{$this->key}-by-$attr";
		$file = $this->path($key);
		$keys = $this->read($file);
		$index = $keys[$value];
		$elm = $content['data'][$index];
		$elm['index'] = $index;
		return $elm;		
	}


	/*
	 * Builds an index file named "[key]-by-[attr]".
	 * Genera un archivo de índice nombrado como "[key]-by-[attr]".
	 * @param string $attr there must not be duplicates.
	 */	
	function buildIndex($attr)
	{
		$content = $this->read();
		$key = "{$this->key}-by-$attr";
		$file = $this->path($key);
		foreach($content['data'] as $index=>$elm) {
			$data[$elm[$attr]] = $index;
		}
		return $this->update($data, $file);
	}


// REFACTORIZANDO --------------------------------------------------------------


	/*
	 * Genera el archivo de almacenamiento actual.
	 * Es un archivo PHP que contiene un array con los datos gestionados
	 * y otra información relativa al propio fichero.
	 */
	function OFFbuild($settings=array())
	{		
		if (file_exists($this->file)) {
			return;
		}
		$content = array(
			'file' => basename($this->file)
			, 'created' => date('Y-m-d H:i:s')
			, 'updated' => null
		);
		if (!empty($settings['attrs'])) {
			$content = array_merge($content, $settings['attrs']);
		}
		$content ['data'] = array();
		return $this->save($content);
	}



}