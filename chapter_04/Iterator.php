<?php
class BasicIterator implements Iterator {
    private $key = 0;
    private $data = array(
        "hello",
        "world",
    );  

    public function __construct() {
        $this->key = 0;
    }

    public function rewind() {
        $this->key = 0;
    }

    public function current() {
        return $this->data[$this->key];
    }

    public function key() {
        return $this->key;
    }

    public function next() {
        $this->key++;
        return true;
    }

    public function valid() {
        return isset($this->data[$this->key]);
    }
}

$iterator = new BasicIterator();
$iterator->rewind();

do {
  $key = $iterator->key();
  $value = $iterator->current();
  echo $key .': ' .$value . PHP_EOL;
} while ($iterator->next() && $iterator->valid());


$iterator = new BasicIterator();
foreach ($iterator as $key => $value) {
  echo $key .': ' .$value . PHP_EOL;
}
?>