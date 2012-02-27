<?php
$db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');

$sql = 'SELECT name, description 
        FROM recipes
        WHERE chef = :chef
        AND category_id = :category_id';

$stmt = $db_conn->prepare($sql);
  
// bind the chef value, we only want Lorna's recipes
$stmt->bindValue(':chef', 'Lorna');

// starters
$stmt->bindValue(':category_id', 1);
$stmt->execute();
$starters = $stmt->fetch();

// pudding
$stmt->bindValue(':category_id', 3);
$stmt->execute();
$pudding = $stmt->fetch();
?>