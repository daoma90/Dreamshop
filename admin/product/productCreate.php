<?php

require_once "../includes/db.php";

if (isset($_POST['addProduct'])) {

  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $cat_id = trim($_POST['cat_id']);
  $in_stock = trim($_POST['in_stock']);
  $featured = trim($_POST['featured']);
  $isOld = trim($_POST['is_old']);


  $sql = "INSERT INTO products(name,description,price, image, featured,in_stock,cat_id, is_old) VALUES(:name,:description,:price, :image, :featured,:in_stock,:cat_id, :is_old)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':image' => "",
    ':featured' => $featured,
    ':in_stock' => $in_stock,
    ':cat_id' => $cat_id,
    ':is_old' => $isOld,
  ]);

  $ID = $pdo->lastInsertId();

  
  $salePercentage = 0.9;
  if($isOld > 0) {
    $sql = "UPDATE products SET sale_price = price * $salePercentage WHERE is_old = 1 AND sale_price = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
  }

  $targetDir = "../images/";
  $allowTypes = array("jpg", "png", "jpeg", "gif", "JPG", "PNG", "GIF");
  $file;

  $fileNames = array_filter($_FILES["image"]["name"]);
  if (isset($ID)) {
    if (!empty($fileNames)) {
      foreach ($_FILES["image"]["name"] as $key => $val) {
        $fileName = basename($_FILES["image"]["name"][$key]);
        $targetDir = $targetDir . $fileName;
        $fileType = pathinfo($targetDir, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], "../images/$fileName")) {
            $sql = "INSERT INTO images(image, product_id) VALUES (:image,:product_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
              ':image' => $fileName,
              ':product_id' => $ID,
            ]);
            $file = $fileName;
          }
        }
        $sql = "UPDATE products SET image=:image WHERE ID=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ':id' => $ID,
          ':image' => $file,
        ]);
      }
    }
  }
 header('Location:products.php');
}
