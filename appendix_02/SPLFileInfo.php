<?php
// Create a temporary file

// Uses up-to 2MB of memory by default, then moves to disk
// Use -1 to only use memory, or 0 to not use memory
$file = new SplFileObject($_FILES["file"]["tmp_name"]);

while ($row = $file->fgetcsv()) {
  // Handle the CSV data array
}
?>