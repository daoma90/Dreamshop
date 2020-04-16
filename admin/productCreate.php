<?php 

  require_once "./assets/php/db.php";


  //  and !empty($fileName)
  if (isset($_POST['addProduct'])) {

    $targetDir = "../images";
    $fileName = $_FILES["image"]["name"];
    $temp_name  = $_FILES['image']['tmp_name'];
    $targetFilePath = $targetDir . $fileName;

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $cat_id = trim($_POST['cat_id']);
    $in_stock = trim($_POST['in_stock']);
    $featured = trim($_POST['featured']);
    if (isset($fileName) and !empty($fileName)) {

      if (move_uploaded_file($temp_name, $targetFilePath)) {

        $sql = "INSERT INTO products(name,description,price,image,featured,in_stock,cat_id) VALUES(:name,:description,:price,:fileName,:featured,:in_stock,:cat_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ':name' => $name,
          ':description' => $description,
          ':price' => $price,
          ':fileName' => $fileName,
          ':featured' => $featured,
          ':in_stock' => $in_stock,
          ':cat_id' => $cat_id,

        ]);
        
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
?>