<?php
    // $db_server = "localhost";
    // $db_database = "jlwvfkou_wp888";
    // $db_username = "jlwvfkou_wp888";
    // $db_password = 'JSU8Sp83[!';

    $db_server = "localhost";
    $db_database = "webshop_cms_sql";
    $db_username = "root";
    $db_password = "root";
    try{
    $db = new PDO("mysql:host=$db_server;dbname=$db_database;charset=utf8",$db_username,$db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
    echo $e-> getMessage();
    }
?>