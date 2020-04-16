<?php

$dsn = "mysql:host=localhost;dbname=webshop_cms";
//$dsn = "mysql:host=localhost;dbname=webshop_cms";
try {
  $pdo = new PDO($dsn, 'ramy', 'test12345');
  //username & password should change accordingly
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
