<?php 
header("Content-Type: application/json; charset=UTF-8");


require_once 'db.php';

$id = $_GET['id'];
$productObj = [];

$sql = "SELECT * FROM products WHERE ID = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);

$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $product = array(
        "id"=>$row['ID'],
        "name"=>$row['name'],
        "description"=>$row['description'],
        "price"=>$row['price'],
        "image"=>$row['image']
    );

    $productObj[] = $product;

endwhile;

$json = json_encode($productObj, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

echo $json;

?>

    
