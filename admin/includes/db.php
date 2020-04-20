<?php

$dsn = "mysql:host=localhost;dbname=jlwvfkou_wp888;charset=utf8";
try {
  $pdo = new PDO($dsn, 'jlwvfkou_wp888', 'JSU8Sp83[!');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}