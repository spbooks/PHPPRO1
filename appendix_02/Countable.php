<?php
class InaccurateCount {
  public $data = array();
  
  public function __construct()
  {
    $this->data = array('foo', 'bar', 'baz');
  }
}

$i = new InaccurateCount();

echo sizeof($i);

class AccurateCount implements Countable {
  public $data = array();
  
  public function __construct()
  {
    $this->data = array('foo', 'bar', 'baz');
  }
  
  public function count() {
    return sizeof($this->data);
  }
}

$i = new AccurateCount();

echo sizeof($i);
