<?php
class EvenFilterIterator extends FilterIterator {
  /**
   * Accept only even-keyed values
   * 
   * @return bool
   */
  public function accept()
  {
    // Get the actual iterator
    $iterator = $this->getInnerIterator();
    
    // Get the current key
    $key = $iterator->key();
    
    // Check for even keys    
    if ($key % 2 == 0) {
      return true;
    }
    
    return false;
  }
}

$array = array(
  0 => "Hello",
  1 => "Everybody Is",
  2 => "I'm",
  3 => "Amazing",
  4 => "The",
  5 => "Who",
  6 => "Doctor",
  7 => "Lives"
);

// Create an iterator from our array
$iterator = new ArrayIterator($array);

// Create our FilterIterator
$filterIterator = new EvenFilterIterator($iterator);

// Iterate
foreach ($filterIterator as $key => $value) {
  echo $key .': '. $value . PHP_EOL;
}
?>