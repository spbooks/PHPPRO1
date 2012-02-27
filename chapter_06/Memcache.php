<?php
/**
 * Memcache Wrapper
 */

/**
 * Memcache Wrapper
 *
 * Allows for partitioned cache
 * that can be cleared on a partition basis.
 * 
 * Uses keys that consist of a partition, followed
 * by the current namespace key, followed by the
 * cached items key e.g. sql_128_$sha1ofquery
 */
class Cache_Memcache {
	/**
	 * @var bool Whether we are connected to at least one server in the pool
	 */
	protected $connected = false;

	/**
	 * @var Memcache
	 */
	protected $memcache = null;
  
  protected $pool = array(
    array('host' => 'localhost', 'port' => '11211', 'weight' => 1),
    // Define other hosts here
  );

	/**
	 * Constructor
	 */
	public function  __construct() {
		$this->connect();
	}

	public function isConnected()
	{
		return $this->connected;
	}

	/**
	 * Connect to the memcached pool
	 *
	 * @return void
	 */
	protected function connect() {
		$this->connected = false;

    $this->memcache = new Memcache();
		foreach($this->pool as $host) {
			$this->memcache->addServer($host['host'], $host['port'], true, $host['weight']);
			
      // Confirm that at least one server in the pool connected
      $stats = $this->memcache->getExtendedStats();
			if ($this->connected || ($stats["{$host['host']}:{$host['port']}"] !== false && sizeof($stats["{$host['host']}:{$host['port']}"]) > 0)) {
				$this->connected = true;
			}
		}

		return $this->connected;
	}

	/**
	 * Returns the namespace value for the current partition
   * 
   * This method will create a new namespace key for the current partition.
   * 
   * To clear the cache for a specific partition of the cache, just increment
   * this key.
	 *
	 * @param string $key
	 * @return string
	 */
	protected function addNamespace($partition = '') {
    // If we're not connected, just return false
		if(!$this->connected) {
			return false;
		}

    // Get the current namespace key
		$ns_key = $this->memcache->get($partition);
		if($ns_key == false) {
      // No key currently set, set one at random
			$ns_key = rand(1, 10000);
			$result = $this->memcache->set($partition, $ns_key, 0, 0);
		}
    
    // Return the key with the naamespace key
		$my_key = $partition."_".$ns_key."_".$key;

		return $my_key;
	}

	/**
	 * Clears the cache by incrementing the namespace key
	 *
	 * @return void
	 */
	public function clearCache($partition = '') {
		if (!$this->connected) {
			return false;
		}

    // Memcache has a built in increment method
		$this->memcache->increment($partition);
	}

	/**
	 * Add a value to the cache
   * 
   * Will also add a metadata key
   * with modified date and split
   * large values (>=1MB) across
   * multiple keys automatically.
	 *
	 * @param string $key
	 * @param string $value
	 * @param int $expires
	 * @return boolean
	 */
	public function set($key, $value, $partition = '', $expires = 14400) {
    // Define a constant so we don't have a magic number
		define('ONE_MB', 1 * 1024 * 1024);
    
		if (!$this->connected) {
			return false;
		} elseif (strlen($value) >= ONE_MB) {
      // Value is more than 1MB, split it
			$value = str_split($value, ONE_MB);
		}

    // Set an expiration of now plus timeout
		if ($expires !== 0) {
			$expires += time();
		}

    // Add the partion and namespace key to our item key
		$ns_key = $this->addNameSpace($key, $partition);
		
		$this->memcache->set($ns_key.'_metadata', json_encode((object) array("modified" => gmdate('D, d M Y H:i:s') . ' GMT', 'slabs' => sizeof($value))), MEMCACHE_COMPRESSED, $expires);

    // If our value is split, we need to store it in mulitple keys
		if (is_array($value)) {
			foreach ($value as $k => $v) {
        // Add an incrementing number to the key and store the chunk
				$this->memcache->set($ns_key . '_' .$k, $v, MEMCACHE_COMPRESSED, $expires);
			}
			return true;
		}
		
		return $this->memcache->set($ns_key, $value, MEMCACHE_COMPRESSED, $expires);
	}

	/**
	 * Returns the data for a given key. 
   * 
   * Returns false if no data exists.
   * 
   * Automatically fetches the metadata key
   * and sends the Last-Modified header.
   * 
   * Automatically retrieves large values split
   * across multiple slabs.
   * 
   * Also sends an X-Cache-Hit header to indicate
   * if the item was found in the cache.
	 *
	 * @param string $key
	 * @return string
	 */
	public function get($key, $partition = '') {
		if (!$this->connected) {
			return false;
		}

		$ns_key = $this->addNameSpace($key, $partition);

		$meta = $this->memcache->get($ns_key.'_metadata');
		
    // Send appropriate headers
		if ($meta && !empty($meta) && !headers_sent()) {
			$meta = json_decode($meta);
			header("X-Cache-Hit: 1", false);
			if (isset($meta->modified)) {
				header('Last-Modified: ' .$meta->modified);
			}
		} elseif (!$meta && !headers_sent()) {
			header("X-Cache-Hit: 0", false);
			return false;
		}
		
    // Retrieve data split across multiple keys
    $value = '';
		if ($meta && isset($meta->slabs) && $meta->slabs > 1) {
      // Item is split across keys
			for ($i = 0; $i < $meta->slabs; $i++) {
        // Concat each key to the previously returned data
				$value .= $this->memcache->get($ns_key . '_' .$i);
			}
		} else {
      // Item is not split
			$value = $this->memcache->get($ns_key);
		}
		
		return $value;
	}

	/**
	 * Deletes the data for a given key.
   * 
   * Returns true on successful deletion, false if unsuccessful.
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function delete($key, $partition = '') {
		if (!$this->connected) {
			return false;
		}

		return $this->memcache->delete($this->addNamespace($key, $partition));
	}
}
?>