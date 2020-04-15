<?php
require_once './assets/php/db.php';

if(isset($_GET['ID'])){
    $ID = htmlspecialchars($_GET['ID']);
  $sql = "DELETE FROM category WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':ID', $ID);
  $stmt->execute();
  header('Location:index.php');
}
?>