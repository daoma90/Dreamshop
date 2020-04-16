<?php

require_once "../includes/db.php";

if (isset($_POST['addProduct'])) {;

  $imageName = $_FILES['image']['name'];
  $imageError = $_FILES['image']['error'];
  $imageTemp = $_FILES['image']['tmp_name'];
  $imagePath = "../images/";

  if (is_uploaded_file($imageTemp)) {
    move_uploaded_file($imageTemp, $imagePath . $imageName);
  } else {
    $image = "";
  }

  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $cat_id = trim($_POST['cat_id']);
  $in_stock = trim($_POST['in_stock']);
  $featured = trim($_POST['featured']);
  $image = htmlspecialchars($imageName);

  $sql = "INSERT INTO products(name,description,price,image,featured,in_stock,cat_id) VALUES(:name,:description,:price,:fileName,:featured,:in_stock,:cat_id)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':fileName' => $image,
    ':featured' => $featured,
    ':in_stock' => $in_stock,
    ':cat_id' => $cat_id,

  ]);

  header('Location:products.php');
} else {
  echo  "Sorry, there was an error uploading your file.";
}
