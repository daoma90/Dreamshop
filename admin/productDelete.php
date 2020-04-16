<?php 
    require_once "./assets/php/db.php";

    $id = $_POST['ID'];
    $sql = 'DELETE FROM products WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id
    ]);

?>
