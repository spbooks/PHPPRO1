<?php
try { 
  $db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');
} catch (PDOException $e) {
  echo "Could not connect to database";
  exit;
}

try {
  // start the transaction
  $db_conn->beginTransaction();

  $db_conn->exec('UPDATE categories SET id=17 WHERE name = "Pudding"');
  $db_conn->exec('UPDATE recipes SET category_id=17 WHERE category_id=3');

  // we made it!
  $db_conn->commit();

} catch (PDOException $e) {
  $db_conn->rollBack();
  echo "Something went wrong: " . $e->getMessage();
}
?>