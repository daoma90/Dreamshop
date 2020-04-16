<?php

require_once "../includes/db.php";


if (isset($_POST['updateProduct'])) {

  $targetDir = "../images/";
  $fileName = $_FILES["image"]["name"];
  $temp_name  = $_FILES['image']['tmp_name'];
  $targetFilePath = $targetDir . $fileName;
  echo $fileName;

  $id = $_POST['update-id'];
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $cat_id = trim($_POST['cat_id']);
  $featured = trim($_POST['featured']);
  $in_stock = trim($_POST['in_stock']);

  if (isset($fileName) and !empty($fileName)) {

    if (move_uploaded_file($temp_name, $targetFilePath)) {


      $sql = 'UPDATE products SET name=:name,description=:description,price=:price,image=:fileName,featured=:featured,in_stock=:in_stock,cat_id=:cat_id WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':fileName' => $fileName,
        ':featured' => $featured,
        ':in_stock' => $in_stock,
        ':cat_id' => $cat_id,
        ':id' => $id

      ]);
      deletingImageNotInUse($fileName, $imageNameFromDB); //deleting image that not in use
      header('Location:products.php');
    } else {
      echo  "Sorry, there was an error uploading your file.";
    }
  } else {
    echo 'You should select a file to upload !!';
  }
} else {
  echo 'You cant leave field empty';
}



function deletingImageNotInUse($fileName, $imageNameFromDB)
{
  if ($fileName != $imageNameFromDB) {

    $file_to_delete = '../images/' . $imageNameFromDB;
    unlink($file_to_delete);
  }
}
