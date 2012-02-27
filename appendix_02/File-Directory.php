<?php
$path = "/Users/davey/Sites/";

$directoryIterator = new RecursiveDirectoryIterator($path);

$recursiveIterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);

foreach ($recursiveIterator as $file) {
  /* @var $file SplFileInfo */
  echo str_repeat("\t", $recursiveIterator->getDepth());
  if ($file->isDir()) {
    echo DIRECTORY_SEPARATOR;
  }
  echo $file->getBasename();
  if ($file->isFile()) {
    echo " (" .$file->getSize(). " bytes)";
  } elseif ($file->isLink()) {
    echo " (symlink)";
  }
  echo PHP_EOL;
}
?>