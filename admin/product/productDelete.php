<?php 
    require_once "../includes/db.php";


    try {
      $id = trim($_GET['ID']);
      $sql = 'DELETE FROM images WHERE product_id=:product_id';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':product_id' => $id
      ]);

      $sql = 'DELETE FROM products WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':id' => $id
      ]);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

?>
