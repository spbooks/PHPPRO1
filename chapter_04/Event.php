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
    if (!is_callable($callback)) {
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
        // The callback is either a closure, or an object that defines __invoke()
        $callback($data);
      }
    }
  }
}
?>