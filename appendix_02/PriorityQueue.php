<?php
$queue = new SplPriorityQueue();
$queue->insert('foo', 1);
$queue->insert('bar', 3);
$queue->insert('baz', 0);

foreach ($queue as $value) {
  echo $value . PHP_EOL;
}
?>