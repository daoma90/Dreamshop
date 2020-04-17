<?php
require_once '../includes/db.php';

if(isset($_GET['ID'])){
    $ID = htmlspecialchars($_GET['ID']);
  $sql = "DELETE FROM category WHERE ID = :ID";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':ID', $ID);
  $stmt->execute();
  header('Location:../index.php');
}