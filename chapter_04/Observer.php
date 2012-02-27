<?php
/**
 * The Event Class
 * 
 * With this class you can register callbacks that will
 * be called (FIFO) for a given event.
 */
class Event {
  /**
   * @var array A multi-dimentional array of events => callbacks
   */
  static protected $callbacks = array();
  
  /**
   * Register a callback
   * 
   * @param string $eventName Name of the triggering event
   * @param mixed $callback An instance of Event_Callback or a Closure
   */
  static public function registerCallback($eventName, $callback)
  {
    if (!($callback instanceof Event_Callback) && !($callback instanceof Closure)) {
      throw new Exception("Invalid callback!");
    }
    
    $eventName = strtolower($eventName);
    
    self::$callbacks[$eventName][] = $callback;
  }
  
  /**
   * Trigger an event
   * 
   * @param string $eventName Name of the event to be triggered
   * @param mixed $data The data to be sent to the callback
   */
  static public function trigger($eventName, $data)
  {
    $eventName = strtolower($eventName);
    
    if (isset(self::$callbacks[$eventName])) {
      foreach (self::$callbacks[$eventName] as $callback) {
        self::callback($callback, $data);
      }
    }
  }
  
  /**
   * Perform the callback
   * 
   * @param mixed $callback An instance of Event_Callback or a Closure
   * @param mixed $data The data sent to the callback
   */
  static protected function callback($callback, $data)
  {
    if ($callback instanceof Closure) {
      $callback($data);
    } else {  
      $callback->run($data);
    }
  }
}

/**
 * The Event Callback interface
 * 
 * If you do not wish to use a closure
 * you can define a class that extends
 * this instead. The run method will be
 * called when the event is triggered.
 */
interface Event_Callback {
  public function run($data);
}

/**
 * Logger callback
 */
class LogCallback implements Event_Callback {
  public function run($data)
  {
    echo "Log Data" . PHP_EOL; 
    var_dump($data);
  }
}

// Register the log callback
Event::registerCallback('save', new LogCallback());

// Register the clear cache callback as a closure
Event::registerCallback('save', function ($data) { 
                                  echo "Clear Cache" . PHP_EOL; 
                                  var_dump($data);
                                });

class MyDataRecord {
  public function save()
  {
    // Save data
    
    // Trigger the save event
    Event::trigger('save', array("Hello", "World"));
  }
}

// Instantiate a new data record
$data = new MyDataRecord();
$data->save(); // 'save' Event is triggered here
