<?php
$db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');

// update to add the categories where we forgot
$sql = 'UPDATE recipes SET category_id = :id
        WHERE category_id is NULL';

$stmt = $db_conn->prepare($sql);

// perform query
$stmt->execute(array(':id' => 2));
echo $stmt->rowCount() . ' rows updated';
?>