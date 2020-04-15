<?php

$dsn = "mysql:host=localhost;dbname=frontend_project";
try {
  $pdo = new PDO($dsn, 'root', '');
  //username & password should change accordingly
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
