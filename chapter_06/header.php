<?php
// Only run if the xhprof extension is enabled
if (extension_loaded('xhprof')) {
  // Include the xhprof classes
  include_once '/path/to/xhprof_lib/utils/xhprof_lib.php';
  include_once '/path/to/xhprof_lib/utils/xhprof_runs.php';

  // Start the profiler capturing CPU and Memory data.
  xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
}
?>