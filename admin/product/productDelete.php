<?php 
    require_once "../includes/db.php";

    $id = trim($_GET['ID']);
    $sql = 'DELETE FROM products WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id
    ]);

?>
