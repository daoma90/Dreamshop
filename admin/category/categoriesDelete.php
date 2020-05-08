<?php
require_once '../includes/db.php';

try {
  if(isset($_GET['ID'])){
    $ID = htmlspecialchars($_GET['ID']);
    $sql = "DELETE FROM category WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();
  }
} catch(PDOException $e) {
  echo $e->getMessage();
}