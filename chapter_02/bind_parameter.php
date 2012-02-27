<?php
$db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');

// query for one recipe
$sql = 'SELECT recipes.name, recipes.description, categories.name as category
        FROM recipes
        INNER JOIN categories ON categories.id = recipes.category_id
        WHERE recipes.chef = :chef
        AND categories.name = :category_name';

$stmt = $db_conn->prepare($sql);
  
// bind the chef value, we only want Lorna's recipes
$stmt->bindValue(':chef', 'Lorna');
$stmt->bindParam(':category_name', $category);

// starters
$category = 'Starter';
$stmt->execute();
$starters = $stmt->fetchAll();

// pudding
$category = 'Pudding';
$stmt->execute();
$pudding = $stmt->fetchAll();
?>