<?php
$stack = new SplStack();
$stack->push(1);
$stack->push(2);
$stack->push(3);

foreach ($stack as $value) {
  echo $value . PHP_EOL;
}

$queue = new SplQueue();
$queue->push(1);
$queue->push(2);
$queue->push(3);

foreach ($queue as $value) {
  echo $value . PHP_EOL;
}
?>