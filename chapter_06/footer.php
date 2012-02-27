<?php
if (extension_loaded('xhprof')) {
  $ns = 'myapp';  // namespace for your application
  
  // Turn off the profiler
  $xhprof_data = xhprof_disable();
  
  // Instantiate the class to save our run
  $xhprof_runs = new XHProfRuns_Default();
  // Save the run
  $run_id = $xhprof_runs->save_run($xhprof_data, $ns);
 
  // url to the XHProf UI libraries 
  $url = 'http://example.org/xhprof_html/index.php';
  $url .= '?run=%s&source=%s';

  // Replace the placeholders
  $url = sprintf($url, $run_id, $ns);
  
  // Display the URL
  echo "<a href='$url' target='_new'>Profiler Output</a>";
}
?>