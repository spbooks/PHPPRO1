<?php
try { 
  $db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');
} catch (PDOException $e) {
  echo "Could not connect to database";
}
?>