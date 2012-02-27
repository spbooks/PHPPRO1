<?php
// Session hasn't been started yet, persist the header values
if (!isset($_COOKIE[session_name()])) {
  session_start();
  $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
// Session has started, check the persisted values against the current request
} else {
  session_start();
  if ($_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
    // Force the user to re-authenticate
  }
}
