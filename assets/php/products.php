<?php 


require 'db.php';

$stmt = $db->prepare($sql);
$stmt->execute();

$name = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $name = $row['name'];
    $desc = $row['description'];
    $price = $row['price'];
    $image = $row['image'];
echo "<article class='feature-products__product'>
        <div class='feature-products__img-wrap'><img class='feature-products__img' src='$image' alt=''></div>
        <div class='feature-products__product-title'>$name</div>
        <div class='feature-products__price'>$price kr</div> 
      </article>";
endwhile;

?>
