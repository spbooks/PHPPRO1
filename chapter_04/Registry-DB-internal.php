<?php
abstract class DBConnection extends PDO {
  static public function getInstance($name = null)
  {
    // Get the late-static-binding version of __CLASS__
    $class = get_called_class();

    // Allow passing in a name to get multiple instances
    // If you do not pass a name, it functions as a singleton
    $name = (!is_null($name)) ?: $class;
    if (!Registry::contains($name)) {
      $instance = new $class();
      Registry::add($instance, $name);
    }
    return Registry::get($name);
  }
}

class DBWriteConnection extends DBConnection {
  private function __construct()
  {
     parent::__construct(APP_DB_WRITE_DSN, APP_DB_WRITE_USER, APP_DB_WRITE_PASSWORD);
  }
}

class DBReadConnection extends DBConnection {
  private function __construct()
  {
     parent::__construct(APP_DB_READ_DSN, APP_DB_READ_USER, APP_DB_READ_PASSWORD);
  }
}
?>