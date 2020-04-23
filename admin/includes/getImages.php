<?php 
header("Content-Type: application/json; charset=UTF-8");


require_once 'db.php';

$id = $_GET['id'];
$imageObject = [];

$sql = "SELECT * FROM images WHERE product_id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $images = array(
        "image"=>$row['image'],
    );

    $imageObject[] = $images;

endwhile;

$json = json_encode($imageObject, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

echo $json;

?>

    
