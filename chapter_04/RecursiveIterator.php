<?php
$array = array(
  "Hello", // Level 1
  array(
    "World" // Level 2
  ),
  array(
    "How", // Level 2
    array(
      "are", // Level 3
      "you" // Level 3
    )
  ),
  "doing?" // Level 1
);

$recursiveIterator = new RecursiveArrayIterator($array);

$recursiveIteratorIterator = new RecursiveIteratorIterator($recursiveIterator);

foreach ($recursiveIteratorIterator as $key => $value) {
  echo "Depth: " . $recursiveIteratorIterator->getDepth() . PHP_EOL;
  echo "Key: " . $key . PHP_EOL;
  echo "Value: " .$value . PHP_EOL;
}
?>