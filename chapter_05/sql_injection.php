<?php

$query = 'SELECT user_id FROM users WHERE username = ? AND password = ?';
$statement = $pdo->prepare($query);
$statement->execute(array($_POST['username'], $_POST['password']));
