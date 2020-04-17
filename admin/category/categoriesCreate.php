
<?php
require_once "./includes/db.php";

if (isset($_POST["addCat"])) {

    $imageName = $_FILES['image']['name'];
    $imageError = $_FILES['image']['error'];
    $imageTemp = $_FILES['image']['tmp_name'];
    $imagePath = "./images/";

    if (is_uploaded_file($imageTemp)) {
        move_uploaded_file($imageTemp, $imagePath . $imageName);
    } else {
        $image = "";
    }

    $sql = "INSERT INTO category (name, image)
            VALUES (:name, :image) ";

    $stmt = $pdo->prepare($sql);

    $name = htmlspecialchars($_POST['name']);
    $image = htmlspecialchars($imageName);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image', $image);

    $stmt->execute();
    header("Location: index.php");
}
?>