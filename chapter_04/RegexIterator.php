<?php
// Create a RecursiveDirectoryIterator
$directoryIterator = new RecursiveDirectoryIterator("./");

// Create a RecursiveIteratorIterator to recursively iterate
$recursiveIterator = new RecursiveIteratorIterator($directoryIterator);

// Createa filter for *Iterator*.php files
$regexFilter = new RegexIterator($recursiveIterator, '/(.*?)Iterator(.*?)\.php$/');

// Iterate
foreach ($regexFilter as $key => $file) {
  /* @var SplFileInfo $file */
  echo $file->getFilename() . PHP_EOL;
}
?>