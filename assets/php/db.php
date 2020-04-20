<?php

$dsn = "mysql:host=localhost;dbname=webshop_cms;charset=utf8";
try {
    $db = new PDO($dsn, 'ramy', 'test12345');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
