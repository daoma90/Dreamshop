<?php
require_once "./assets/php/db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $imageName = $_FILES['image']['name'];
    $imageError = $_FILES['image']['error'];
    $imageTemp = $_FILES['image']['tmp_name'];
    $imagePath = "./assets/media/";

    if(is_uploaded_file($imageTemp)) {
        $image = "./assets/media/";
        move_uploaded_file($imageTemp, $imagePath . $imageName);
    } else {
        $image = "";
    }

    $sql = "INSERT INTO category (name, image)
            VALUES (:name, :image) ";

    $stmt = $db->prepare($sql);

    $name = htmlspecialchars($_POST['name']);
    $image .= htmlspecialchars($imageName);

    $stmt->bindParam(':name', $name );
    $stmt->bindParam(':image' , $image);

    $stmt->execute();

}
?>

    <div class="form-container">
        <div class="form-container__headline-container">
            <h2 class="form-container__headline">Add Category</h2>
        </div>
        <form method="POST" action="Index.php" enctype="multipart/form-data" class="form-container__form">
            <label class="form-container__label" for="image">Titel</label>
            <input type="text" class="form-container__title" name="name">
            <label class="form-container__label" for="image">Ladda upp bild</label>
            <input type="file" name="image" accept="image/" class="form-container__img-file">
            <div class="form-container__submit-container">
                <input type="submit" class="form-container__submit" value="Skicka">
            </div>
        </form>
    </div>

</section> 