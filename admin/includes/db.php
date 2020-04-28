<?php

<<<<<<< HEAD
$db_server = "localhost";
$db_database = "jlwvfkou_wp888";
$db_username = "root";
$db_password = 'root'; 
=======
    $db_server = "localhost";
    $db_database = "jlwvfkou_wp888";
    $db_username = "jlwvfkou_wp888";
    $db_password = 'JSU8Sp83[!';
>>>>>>> 1f9695848f6af1ffc648ef655126101c5de7f171




$dsn = "mysql:host=$db_server;dbname=$db_database;charset=utf8";
try {
  $pdo = new PDO($dsn, $db_username, $db_password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}