<?php
//This Courier class contains the bulk of methods and properties from code examples in Chapter 1;
//some methods/properties are commented out so as not to cause a redeclaration error.
//Comment and uncomment the methods and properties you require at will!
class Courier
{
  public $name;
  public $home_country;
  
  
  //First constructor: remember, you can only use one constructor (so leave this or the ones below commented out,
  //depending on which ones you require),
  //and it's best practice to declare it before all other methods in your class
  /*public function __construct($name) {
    $this->name = $name;
    return true;
  }*/
  
  //Second constructor
  public function __construct($name, $home_country) {
    $this->name = $name;
    $this->home_country = $home_country;
    return true;
  }
  
  //Third constructor
  /*public function __construct($name, $home_country) {
    $this->name = $name;
    $this->home_country = $home_country;
    $this->logfile = $this->getLogFile();
    return true;
  }*/
  
  protected function getLogFile() {
    // error log location would be in a config file
    return fopen('/tmp/error_log.txt', 'a');
  }

  public function log($message) {
    if($this->logfile) {
      fputs($this->logfile, 'Log message: ' . $message . "\n");
    }
  }

  public function __sleep() {
    // only store the "safe" properties
    return array("name", "home_country");
  }

  public function __wakeup() {
    // properties are restored, now add the logfile
    $this->logfile = $this->getLogFile();
    return true;
  }
  
  public function __toString() {
    return $this->name . ' (' . $this->home_country . ')';
  }
  
  //Namespacing and static method
  //namespace shipping;
  public static function getCouriersByCountry($country) {
    // get a list of couriers with their home_country = $country

    // create a Courier object for each result

    // return an array of the results
    return $courier_list;
  }

  public function ship($parcel) {
    // sends the parcel to its destination
    return true;
  }

  /*public function calculateShipping($parcel) {
    // look up the rate for the destination, we'll invent one
    $rate = 1.78;

    // calculate the cost
    $cost = $rate * $parcel->weight;
    return $cost;
  }*/
  
  public function calculateShipping(Parcel $parcel) {
    // look up the rate for the destination
    $rate = $this->getShippingRateForCountry($parcel->destinationCountry);
    // calculate the cost
    $cost = $rate * $parcel->weight;
    return $cost;
  }

  private function getShippingRateForCountry($country) {
    // some excellent rate calculating code goes here
    // for the example, we'll just think of a number
    return 1.2;
  }
  
  //First style of getter and setter methods and protected $name property
  /*protected $name;

  function getName() {
    return $this->name;
  }

  function setName($value) {
    $this->name = $value;
    return true;
  }*/
  
  //Magic __get() and __set() methods
  protected $data = array();

  public function __get($property) {
    return $this->data[$property];
  }

  public function __set($property, $value) {
    $this->data[$property] = $value;
    return true;
  }
  
  
  public function __call($name, $params) {
    if($name == 'sendParcel') {
      // legacy system requirement, pass to newer send() method
      return $this->send($params[0]);
    } else {
      error_log('Failed call to ' . $name . ' in Courier class');
      return false;
    }
  }
} //end of Courier class


// Courier class with a Countable interface
/*class Courier implements Countable
{
  protected $count = 0;

  public function ship(Parcel $parcel) {
    $this->count++;
    // ship parcel
    return true;
  }

  public function count() {
    return $this->count;
  }
}*/
?>