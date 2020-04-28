<?php 
    
$salePercentage = 0.9;

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
    $isOld = $row['is_old'];

    $addToCartBtn = "<button class='feature-products__add' data-id=$id>ADD TO CART</button>";
    if ($stock == 0) {
        $addToCartBtn = "<div class='feature-products__oos'>OUT OF STOCK</div>";
    }
    if ($isOld == 1) {


        $sale_price = $price * $salePercentage;
        $sale = "
        <div class='feature-products__price'>
            <span class='old-price'>$price SEK</span>
            <span class='on-sale'>-10%</span>
            <span class='new-price'>$sale_price SEK</span>
        </div>";
    }
    else {
        $sale = "<span class='old-price'>$price SEK</span>";
    }


echo "<article class='feature-products__product'>
        <a class='feature-products__link-wrap' href='./product.php?id=$id'>
        <div class='feature-products__img-wrap'><img class='feature-products__img' src='./admin/images/$image' alt=''></div>
        <div class='feature-products__product-title'>$name</div>
        $sale
        <div class='feature-products__stock'>IN STOCK: $stock</div>
        </a>
        $addToCartBtn
      </article>";
endwhile;

$sql = "UPDATE products SET sale_price = price * $salePercentage WHERE is_old = 1 AND sale_price = 0";
$stmt = $db->prepare($sql);
$stmt->execute();

?>
