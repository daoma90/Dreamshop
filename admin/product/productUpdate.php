<?php

require "../includes/db.php";

if (isset($_POST['updateProduct'])) {
    $id = $_POST['update-id']; //getting id for update
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $image = "s";
    $in_stock =  trim($_POST['in_stock']);
    $featured =  trim($_POST['featured']);
    // $image = trim($_POST['image']);
    $cat_id = trim($_POST['cat_id']);

    // if (empty($name) || empty($description) || empty($price) || empty($image) || empty($cat_id)) {
    //   echo var_dump($_POST);
    // } else {
      $sql = 'UPDATE products 
      SET name=:name,description=:description,price=:price,image=:image, featured=:featured,in_stock=:in_stock, cat_id=:cat_id WHERE id=:id';
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
      header('Location:products.php');
    }
  // }
?>