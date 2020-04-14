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
  //  and !empty($fileName)
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

  $id = $_POST['val'];
  $sql = 'SELECT * FROM products WHERE id=:id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':id' => $id
  ]);
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  $product_info = array();
  array_push($user_info, $product['id'], $product['name'], $product['description'], $product['price'], $product['image'], $product['cat_id']);
  return $product_info;
}

function updateProduct($pdo)
{
  if (isset($_POST['edit'])) {
    $id = $_POST['update-id']; //getting id for update
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $image = trim($_POST['image']);
    $cat_id = trim($_POST['cat_id']);

    if (empty($name) || empty($description) || empty($price) || empty($image) || empty($cat_id)) {
      echo 'error msg'; //not finalize
    } else {
      $sql = 'UPDATE products SET name=:name,email=:email,description=:description,price=:price,image=:image,cat_id=:cat_id WHERE id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':image' => $image,
        ':cat_id' => $cat_id,

      ]);
      header('Location:index.php');
    }
  }
}
