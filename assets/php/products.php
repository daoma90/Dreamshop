<?php 
    
require 'db.php';

if (!isset($sql)) {
    $sql = "SELECT * FROM products";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}
if (isset($_GET['category'])){
    $sql = "SELECT * FROM category, products WHERE category.ID = products.cat_id AND category.name = :catName";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':catName', $_GET['category']);
    $stmt->execute();
}


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id = $row['ID'];
    $name = $row['name'];
    $desc = $row['description'];
    $price = $row['price'];
    $image = $row['image'];
    $stock = $row['in_stock'];

echo "<article class='feature-products__product'>
        <a class='feature-products__link-wrap' href='./product.php?id=$id'>
        <div class='feature-products__img-wrap'><img class='feature-products__img' src='./admin/images/$image' alt=''></div>
        <div class='feature-products__product-title'>$name</div>
        <div class='feature-products__price'>$price SEK</div>
        <div class='feature-products__stock'>IN STOCK: $stock</div>
        </a>
        <button class='feature-products__add' data-id=$id>ADD TO CART</button>
      </article>";
endwhile;

?>
