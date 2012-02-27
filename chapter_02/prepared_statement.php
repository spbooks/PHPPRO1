<?php
$db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');

// query for one recipe
$sql = 'SELECT name, description, chef 
        FROM recipes
        WHERE id = :recipe_id';

$stmt = $db_conn->prepare($sql);
  
// perform query
$stmt->execute(array(
  "recipe_id" => 1)
);
$recipe = $stmt->fetch();
?>