<?php
$read = new DBReadConnection;
Registry::set($read);

$write = new DBWriteConnection;
Registry::set($write);

// To get the instances, anywhere in our code:
$read = Registry::get('DbReadConnection');
$write = Registry::get('DbWriteConnection');
?>