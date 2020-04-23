<?php

$dsn = "mysql:host=localhost;dbname=frontendproject;charset=utf8";
try {
    $db = new PDO($dsn, 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
