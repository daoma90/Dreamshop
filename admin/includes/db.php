<?php

$db_server = "localhost";
$db_database = "jlwvfkou_wp888";
$db_username = "root";
$db_password = ''; 

try{
$pdo = new PDO("mysql:host=$db_server;dbname=$db_database;charset=utf8",
$db_username, $db_password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}