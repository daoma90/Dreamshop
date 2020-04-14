<?php 
    
require 'db.php';

$sql = "SELECT * FROM products WHERE featured = 1";
$stmt = $db->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id = $row['ID'];
    $name = $row['name'];
    $desc = $row['description'];
    $price = $row['price'];
    $image = $row['image'];

echo "<article class='feature-products__product'>
        <a class='feature-products__link-wrap' href='./product.php?id=$id'>
        <div class='feature-products__img-wrap'><img class='feature-products__img' src='$image' alt=''></div>
        <div class='feature-products__product-title'>$name</div>
        <div class='feature-products__price'>$price SEK</div> 
        </a>
        <button class='feature-products__add' data-id=$id>ADD TO CART</button>
      </article>";
endwhile;

?>
