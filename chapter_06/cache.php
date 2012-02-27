<?php
require_once 'Cache/Memcache.php';
// Instantiate our Cache
$cache = new Cache_Memcache();

// Use the REQUEST_URI as a key
$key = $_SERVER['REQUEST_URI'];

// Try to get our data
$data = $cache->get($key, 'blog-pages');

// If the data is not false, we got something valid
if ($data !== false) {
  echo $data;
} else {
  // Generate data, you can do this with buffering:
  // Start the buffer
  ob_start();
  // output all the data to the buffer
  
  // ...

  // Retrieve and output the data at the same time
  $data = ob_get_flush();
  
  // Add it to the cache.
  $cache->set($key, $data, 'blog-pages');
}
?>