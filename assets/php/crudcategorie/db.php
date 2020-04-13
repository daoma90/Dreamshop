<?php

$db_server = "localhost";
$db_name = "webshop_cms_sql";
$db_username = "root";
$db_password ="root";

try{
    $db = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8",
    $db_username, $db_password);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully "; 
    }
    catch(PDOException $e){
    echo $e-> getMessage();
    }
    