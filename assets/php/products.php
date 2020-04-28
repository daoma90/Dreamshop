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
    $id = htmlspecialchars($row['ID']);
    $name = htmlspecialchars($row['name']);
    $desc = htmlspecialchars($row['description']);
    $price = htmlspecialchars($row['price']);
    $image = htmlspecialchars($row['image']);
    $stock = htmlspecialchars($row['in_stock']);

    $addToCartBtn = "<button class='feature-products__add' data-id=$id>ADD TO CART</button>";
    if ($stock == 0) {
        $addToCartBtn = "<div>OUT OF STOCK</div>";
    }


echo "<article class='feature-products__product'>
        <a class='feature-products__link-wrap' href='./product.php?id=$id'>
        <div class='feature-products__img-wrap'><img class='feature-products__img' src='./admin/images/$image' alt=''></div>
        <div class='feature-products__product-title'>$name</div>
        <div class='feature-products__price'>$price SEK</div>
        <div class='feature-products__stock'>IN STOCK: $stock</div>
        </a>
        $addToCartBtn
      </article>";
endwhile;

?>
