<?php
class MyArray implements ArrayAccess {
  public function offsetExists($offset) {
      return isset($this->{$offset});
  }
  
  public function offsetGet($offset) {
    return $this->{$offset};
  }
  
  public function offsetSet($offset, $value) {
    $this->{$offset} = $value;
  }
  
  public function offsetUnset($offset) {
    unset($this->{$offset});
  }
}

$arrayObj = new MyArray();
$arrayObj['greeting'] = "Hello World";
echo $arrayObj['greeting'];
?>