<?php
require 'servicefunctions.php';

if(isset($_GET['method'])) {
  switch($_GET['method']) {
    case 'countWords':
      $response = ServiceFunctions::countWords($_GET['words']);
      break;
    case 'getDisplayName':
      $response = ServiceFunctions::getdisplayName($_GET['first_name'], $_GET['last_name']);
      break;
    default:
      $response = "Unknown Method";
      break;
  }
} else {
  $response = "Unknown Method";
}

header('Content-Type: application/json');
echo json_encode($response);
?>