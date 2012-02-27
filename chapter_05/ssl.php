<?php
$using_ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443;
if (!$using_ssl) {
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
  exit;
}
