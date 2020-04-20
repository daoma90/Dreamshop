<?php 

require '../includes/db.php';

$id = htmlspecialchars($_GET['id']);
$status = htmlspecialchars($_POST['status']);

$sql = 'UPDATE orders SET status=:status WHERE ID=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':status', $status);
$stmt->execute();

header('Location: orders.php');

?>

