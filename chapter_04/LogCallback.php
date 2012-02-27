<?php
/**
 * Logger callback
 */
class LogCallback {
  public function __invoke($data)
  {
    echo "Log Data" . PHP_EOL; 
    var_dump($data);
  }
}

// Register the log callback
Event::registerCallback('save', new LogCallback());
?>