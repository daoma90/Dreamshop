<?php 
    
require 'db.php';

if (isset($_GET['category'])){
    $sql = "SELECT * FROM category, products WHERE category.ID = products.cat_id AND category.name = :catName";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':catName', $_GET['category']);
    $stmt->execute();
}
else {
    if (!$sql) {
        $sql = "SELECT * FROM products";
    }
    $stmt = $db->prepare($sql);
    $stmt->execute();    
}

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id = $row['ID'];
    $name = $row['name'];
    $desc = $row['description'];
    $price = $row['price'];
    $image = $row['image'];

echo "<article class='feature-products__product' data-id=$id>
        <div class='feature-products__img-wrap'><img class='feature-products__img' src='$image' alt=''></div>
        <div class='feature-products__product-title'>$name</div>
        <div class='feature-products__price'>$price kr</div> 
        <button class='feature-products__add'>Add to cart</button>
      </article>";
endwhile;

?>
