<?php

$dsn = "mysql:host=localhost;dbname=jlwvfkou_wp888";
try {
  $pdo = new PDO($dsn, 'jlwvfkou_wp888', 'JSU8Sp83[!');
  //username & password should change accordingly
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
