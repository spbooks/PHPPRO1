<?php
class Registry {
  /**
   * @var array The store for all of our objects
   */
  static private $_store = array();
  
  /**
   * Add an object to the registry
   * 
   * If you do not specify a name the classname is used
   *
   * @param mixed $object The object to store
   * @param string $name Name used to retrieve the object
   * @return void
   * @throws Exception
   */
  static public function add($object, $name = null)
  {
    // Use the classname if no name given, simulates singleton
    $name = (!is_null($name)) ?: get_class($object);
    $name = strtolower($name);
    
    if (isset(self::$_store[$name])) {
      throw new Exception("Object already exists in registry");
    }
    
    self::$_store[$name]= $object;
  }
  
  /**
   * Get an object from the registry
   *
   * @param string $name Object name, {@see self::set()}
   * @return mixed
   * @throws Exception
   */
  static public function get($name)
  {
    if (!self::contains($name)) {
      throw new Exception("Object does not exist in registry");
    }
    
    return self::$_store[$name];
  }
  
  /**
   * Check if an object is in the registry
   *
   * @param string $name Object name, {@see self::set()}
   * @return bool
   */
  static public function contains($name)
  {
    if (!isset(self::$_store[$name])) {
      return false;
    }
    
    return true;
  }
  
  /**
   * Remove an object from the registry
   *
   * @param string $name Object name, {@see self::set()}
   * @returns void
   */
  static public function remove($name)
  {
    if (self::contains($name)) {
      unset(self::$_store[$name]);
    }
  }
}
?>