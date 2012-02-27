<?php
for ($j = 1; $j < 10000000; $j = $j) {
  $size = $j;

  echo $size . " elements" . PHP_EOL;

  $start = microtime(true);
  for($i = 0; $i < $size; $i++) {
    // do nothing
    $array[$i] = new stdClass();
  }

  for($i = 0; $i < $size; $i++) {
    // do nothing
    $value = $array[$i];
  }
  $end = microtime(true);

  $time = (($end - $start));
  echo "Regular Array: " .$time. "s" . PHP_EOL;
  unset($array);

  $start = microtime(true);
  $fixedArray = new SplFixedArray($size);
  for($i = 0; $i < $size; $i++) {
    // do nothing
    $fixedArray[$i] = new stdClass();
  }

  $start = microtime(true);
  for($i = 0; $i < $size; $i++) {
    // do nothing
    $value = $fixedArray[$i];
  }
  $end = microtime(true);

  $time2 = (($end - $start));
  echo "Fixed Array: " .$time2. "s" . PHP_EOL;

  echo "Factor: " . (($time*1000000)/($time2*1000000)) . PHP_EOL;
  
  $j *= 10;
  
  unset($array); unset($fixedArray);
}