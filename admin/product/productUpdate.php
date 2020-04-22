<?php
require "../includes/db.php";
if (isset($_POST['updateProduct'])) {

  $id = $_POST['update-id']; 
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $in_stock =  trim($_POST['in_stock']);  
  $featured =  trim($_POST['featured']);
  $cat_id = trim($_POST['cat_id']);

  
  $imageName = $_FILES['image']['name'];
  $imageError = $_FILES['image']['error'];
  $imageTemp = $_FILES['image']['tmp_name'];
  $imagePath = "../images/";

  if (is_uploaded_file($imageTemp)) {
    move_uploaded_file($imageTemp, $imagePath . $imageName);
  } else {
    $image = "";
  }
  $image = htmlspecialchars($imageName);

  if(!empty($imageName)) {
    $sql = 'UPDATE products SET name=:name,description=:description,price=:price,image=:image, featured=:featured,in_stock=:in_stock, cat_id=:cat_id WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':name' => $name,
      ':description' => $description,
      ':price' => $price,
      ':image' => $image,
      ':featured' => $featured,
      ':in_stock' => $in_stock,
      ':cat_id' => $cat_id,
    ]);  
  } else {
    $sql = 'UPDATE products SET name=:name,description=:description,price=:price, featured=:featured,in_stock=:in_stock, cat_id=:cat_id WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':name' => $name,
      ':description' => $description,
      ':price' => $price,
      ':featured' => $featured,
      ':in_stock' => $in_stock,
      ':cat_id' => $cat_id,
    ]);  
  }
 header('Location:products.php');
}
