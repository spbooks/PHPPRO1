<?php
$db_conn = new PDO('mysql:host=localhost;dbname=recipes', 'php-user', 'secret');

$stmt = $db_conn->prepare('DELETE FROM categories WHERE name = :name');

// delete the record
$stmt->execute(array(':name' => 'Starter'));
echo $stmt->rowCount() . ' row(s) deleted';
?>