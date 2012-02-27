<?php
$salt = '378570bdf03b25c8efa9bfdcfb64f99e';
$hash = hash_hmac('md5', $_POST['password'], $salt);
$query = 'SELECT user_id FROM users WHERE username = ? AND password = ?';
$statement = $pdo->prepare($query);
$statement->execute(array($_POST['username'], $hash));
