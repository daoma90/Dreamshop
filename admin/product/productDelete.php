<?php
require_once "../inclues/db.php";

$id = $_POST['ID'];
$sql = 'DELETE FROM products WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->execute([
  ':id' => $id
]);
