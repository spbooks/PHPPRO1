<?php
/**
 * Log Class
 */
class Log {
  /**
   * @var Log_Engine_Interface
   */
  protected $engine = false;
  
  /**
   * Add an event to the log
   * 
   * @param string $message 
   */
  public function add($message)
  {
    if (!$this->engine) {
      throw new Exception('Unable to write log. No Engine set.');
    }
    
    $data['datetime'] = time();
    $data['message'] = $message;
    
    $session = Registry::get('session');
    $data['user'] = $session->getUserId();
    
    $this->engine->add($data);
  }
  
  /**
   * Set the log data storage engine
   * 
   * @param Log_Engine_Interface $Engine 
   */
  public function setEngine(Log_Engine_Interface $engine)
  {
    $this->engine = $engine;
  }
  
  /**
   * Retrieve the data storage engine
   * 
   * @return Log_Engine_Interface 
   */
  public function getEngine()
  {
    return $this->engine;
  }
}

interface Log_Engine_Interface {
  /**
   * Add an event to the log
   * 
   * @param string $message 
   */
  public function add(array $data);
}

class Log_Engine_File implements Log_Engine_Interface {
  /**
   * Add an event to the log
   * 
   * @param string $message 
   */
  public function add(array $data)
  {
    $line = '[' .data('r', $data['datetime']). '] ' .$data['message']. ' User: ' .$data['user'] . PHP_EOL;
    
    $config = Registry::get('site-config');
    
    if (!file_put_contents($config['location'], $line, FILE_APPEND)) {
      throw new Exception("An error occurred writing to file.");
    }
  }
}

$engine = new Log_Engine_File();

$log = new Log();
$log->setEngine($engine);

// Add it to the registry
Registry::add($log);