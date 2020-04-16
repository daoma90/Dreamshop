<?php

$dsn = "mysql:host=localhost;dbname=frontendproject";
//$dsn = "mysql:host=localhost;dbname=webshop_cms";
try {
  $pdo = new PDO($dsn, 'root', 'root');
  //username & password should change accordingly
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
