<?php 

require '../includes/db.php';

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE orders SET status=:status WHERE ID=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':status', $status);
$stmt->execute();

?>

