<?php
// Define the array
$array = array(
    'Hello',
    'World',
    'How',
    'are',
    'you',
    'doing?'
);

// Create the iterator
$iterator = new ArrayIterator($array);

// Create the limiting iterator, to get the first 2 elements
$limitIterator = new LimitIterator($iterator, 0, 2);

// Iterate
foreach ($limitIterator as $key => $value) {
  echo $key .': '. $value . PHP_EOL;
}
?>