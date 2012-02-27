<?php
/**
 * PEAR/Zend Framework compatible
 * autoloader.
 * 
 * This autoloader simply converts underscores
 * to sub-directories.
 * 
 * @param string $classname The class to be included
 * @return bool
 */
function MyAutoloader($classname)
{
  // Replace _ with OS appropriate slash and append .php
  $path = str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
  
  // Include the file, use @ to hide errors, that is a valid condition
  $result = @include($classname);
  
  // Return boolean result
  return $result;
}

// If we already have an __autoload, register it, SPL will
// override it otherwise.
if (function_exists('__autoload')) {
  spl_autoload_register('__autoload');
}

// Register our autoloader
spl_autoload_register('MyAutoloader');

$obj = new Some_Class_Name(); // Includes Some/Class/Name.php