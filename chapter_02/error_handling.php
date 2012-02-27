<?php
try { 
  $db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');
} catch (PDOException $e) {
  echo "Could not connect to database";
  exit;
}

$sql = 'SELECT name, description, chef 
        FROM recipes
        WHERE id = :recipe_id';
try {
  $stmt = $db_conn->prepare($sql);
  
  if($stmt) {
    // perform query
    $stmt->execute(array(
      "recipe_id" => 1)
    );

    $recipe = $stmt->fetch();
  }
} catch (PDOException $e) {
  echo "A database problem has occurred: " . $e->getMessage();
}
?>