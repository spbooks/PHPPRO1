<?php
// The Database class represents our global DB connection
class Database extends PDO {
  // A static variable to hold our single instance
  private static $_instance = null;
  
  // Make the constructor private to ensure singleton
  private function __construct()
  {
    // Call the PDO constructor
    parent::__construct(APP_DB_DSN, APP_DB_USER, APP_DB_PASSWORD);
  }

  // A method to get our singleton instance
  public static function getInstance()
  {
    if (!(self::$_instance instanceof Database)) {
      self::$_instance = new Database();
    }
    
    return self::$_instance;
  }
}
?>