<?php

require 'db.php';

function readAll($pdo)
{
  $sql = 'SELECT * FROM products';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return $stmt;
}

//Draws each product based on arr from db
function drawProducts($pdo)
{
    $stmt = readAll($pdo);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<article class='product' id='product_" . $row["ID"] . "'>
                <div class='product__left-info'>
                    <div class='product__left-info-image'><img src='../images" . $row["image"] . "' alt=''></div>
                    <div class='product__btn-wrapper'>
                     <button class='product__btn product__btn--edit' onclick='populateFields(" . $row["ID"] .  ")'>Edit</button>
                     <button class='product__btn product__btn--del' onclick='deleteView(" . $row["ID"] .  ")'>Delete</button>
                    </div>
                </div>
        <div class='product__right-info'>
            <h3 class='name'>" . $row["name"] . "</h3>
            <p class='desc'>" . $row["description"] . " </p>
            <p class='price'>" . $row["price"] . " </p>
            <p class='in_stock'>" . $row["in_stock"] . " </p>
            <p>" . $row["cat_id"] . " '</p>
        </div>
    </article>";
        }
    }
}
//Draws dropdownlist with all categorys
function getCatList($pdo)
{
    $sql = 'SELECT * FROM category';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "<select name='cat_id'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value=" . $row["ID"] . ">" . $row["name"] . "</option>";
        }
        echo "</select>";
    }
}



//ALL FUNCTIONS BELOW IS MOVED OUT AS UNIQUE FILES!!

// function deleteProduct($pdo)
// {
//   if (isset($_POST['delete'])) {
//     $id = $_POST['val'];
//     $sql = 'DELETE FROM products WHERE id=:id';
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([
//       ':id' => $id
//     ]);
//     header('Location: index.php');
//   }
// }


// function createProduct($pdo)
// {
//   //  and !empty($fileName)
//   if (isset($_POST['addProduct'])) {

//     $targetDir = "../images";
//     $fileName = $_FILES["file"]["name"];
//     $temp_name  = $_FILES['file']['tmp_name'];
//     $targetFilePath = $targetDir . $fileName;


//     $name = trim($_POST['name']);
//     $description = trim($_POST['description']);
//     $price = trim($_POST['price']);
//     $cat_id = trim($_POST['cat_id']);
//     $featured = trim($_POST['featured']);
//     $in_stock = trim($_POST['in_stock']);

//     if (isset($fileName) and !empty($fileName)) {

//       if (move_uploaded_file($temp_name, $targetFilePath)) {

//         $sql = "INSERT INTO users(name,description,price,image,featured,in_stock,cat_id) VALUES(:name,:email,:description,:price,:fileName,:featured,:in_stock,:cat_id)";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute([
//           ':name' => $name,
//           ':description' => $description,
//           ':price' => $price,
//           ':fileName' => $fileName,
//           ':featured' => $featured,
//           ':in_stock' => $in_stock,
//           ':cat_id' => $cat_id,

//         ]);
//         header('Location:index.php');
//         echo var_dump($_POST);
//       } else {
//         echo  "Sorry, there was an error uploading your file.";
//       }
//     } else {
//       echo 'You should select a file to upload !!';
//     }
//   } else {
//     echo 'You cant leave field empty';
//   }
// }


// function fillingEditForm($pdo)
// {

//   $id = $_POST['val'];
//   $sql = 'SELECT * FROM products WHERE id=:id';
//   $stmt = $pdo->prepare($sql);
//   $stmt->execute([
//     ':id' => $id
//   ]);
//   $product = $stmt->fetch(PDO::FETCH_ASSOC);
//   $product_info = array();
//   array_push($user_info, $product['id'], $product['name'], $product['description'], $product['price'], $product['image'], $product['cat_id']);
//   return $product_info;
// }

// function updateProduct($pdo)
// {
//   if (isset($_POST['edit'])) {
//     $id = $_POST['update-id']; //getting id for update
//     $name = trim($_POST['name']);
//     $description = trim($_POST['description']);
//     $price = trim($_POST['price']);
//     $image = trim($_POST['image']);
//     $cat_id = trim($_POST['cat_id']);

//     if (empty($name) || empty($description) || empty($price) || empty($image) || empty($cat_id)) {
//       echo 'error msg'; //not finalize
//     } else {
//       $sql = 'UPDATE products SET name=:name,email=:email,description=:description,price=:price,image=:image,cat_id=:cat_id WHERE id=:id';
//       $stmt = $pdo->prepare($sql);
//       $stmt->execute([
//         'id' => $id,
//         ':name' => $name,
//         ':description' => $description,
//         ':price' => $price,
//         ':image' => $image,
//         ':cat_id' => $cat_id,

//       ]);
//       header('Location:index.php');
//     }
//   }
// }

