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
    // if ($row['is_old'] == 1) {
    //     $price = $row['sale_price'];
    // }
    // else {
    //     $price = $row['price'];
    // }
    $product = array(
        "id"=>$row['ID'],
        "name"=>$row['name'],
        "description"=>$row['description'],
        "price"=>$row['price'],
        "image"=>$row['image'],
        "stock"=>$row['in_stock'],
        "sale_price"=>$row['sale_price'],
        "has_discount"=>$row['is_old']
    );

    $productObj[] = $product;

endwhile;

$json = json_encode($productObj, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

echo $json;

?>

    
