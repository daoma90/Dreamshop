<?php


function readAll($pdo)
{
  $sql = 'SELECT * FROM products';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $products;
}

function deleteProduct($pdo)
{
  if (isset($_POST['delete'])) {
    $id = $_POST['val'];
    $sql = 'DELETE FROM products WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id
    ]);
    header('Location: index.php');
  }
}


function createProduct($pdo)
{

  if (isset($_POST['addProduct'])) {

    $targetDir = "../images";
    $fileName = $_FILES["file"]["name"];
    $temp_name  = $_FILES['file']['tmp_name'];
    $targetFilePath = $targetDir . $fileName;


    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $cat_id = trim($_POST['cat_id']);
    $featured = trim($_POST['featured']);
    $in_stock = trim($_POST['in_stock']);

    if (isset($fileName) and !empty($fileName)) {

      if (move_uploaded_file($temp_name, $targetFilePath)) {

        $sql = "INSERT INTO users(name,description,price,image,featured,in_stock,cat_id) VALUES(:name,:email,:description,:price,:fileName,:featured,:in_stock,:cat_id)";
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
        header('Location:index.php');
      } else {
        echo  "Sorry, there was an error uploading your file.";
      }
    } else {
      echo 'You should select a file to upload !!';
    }
  } else {
    echo 'You cant leave field empty';
  }
}





function fillingEditForm($pdo)
{

  $id = $_POST['val']; // gett the id where need be updated
  $sql = 'SELECT * FROM products WHERE id=:id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':id' => $id
  ]);
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  $product_info = array();
  array_push(
    $product_info,
    $product['id'],
    $product['name'],
    $product['description'],
    $product['price'],
    $product['image'], //$imageNameFromDB
    $product['featured'],
    $product['in_stock'],
    $product['cat_id']
  );
  //when you fill data take the image name assign to img tag to get image preview
  return $product_info;
}

function updateProduct($pdo, $imageNameFromDB)
{
  if (isset($_POST['editProduct'])) {

    $targetDir = "../images";
    $fileName = $_FILES["file"]["name"];
    $temp_name  = $_FILES['file']['tmp_name'];
    $targetFilePath = $targetDir . $fileName;


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

        ]);
        deletingImageNotInUse($fileName, $imageNameFromDB); //deleting image that not in use
        header('Location:index.php');
      } else {
        echo  "Sorry, there was an error uploading your file.";
      }
    } else {
      echo 'You should select a file to upload !!';
    }
  } else {
    echo 'You cant leave field empty';
  }
}


function deletingImageNotInUse($fileName, $imageNameFromDB)
{
  if ($fileName != $imageNameFromDB) {

    $file_to_delete = '../images/' . $imageNameFromDB;
    unlink($file_to_delete);
  }
}
