<?php
$array = array("Hello", "World");

foreach ($array as $key => $value) {
  echo $key .': ' .$value . PHP_EOL;
}
?>

<?php
$array = array("Hello", "World");

reset($array);
do {
  $key = key($array);
  $value = current($array);
  echo $key .': ' .$value . PHP_EOL;
} while (next($array));
?>