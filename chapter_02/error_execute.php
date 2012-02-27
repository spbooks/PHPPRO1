<?php
try { 
  $db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');
} catch (PDOException $e) {
  echo "Could not connect to database";
  exit;
}

$stmt = $db_conn->prepare($sql);

if($stmt) {
  // perform query
  $result = $stmt->execute(array(
    "recipe_id" => 1)
  );
  
  if($result) {
    $recipe = $stmt->fetch();
    print_r($recipe);
  } else {
    $error = $stmt->errorInfo();
    echo "Query failed with message: " . $error[2];
  }
}
?>