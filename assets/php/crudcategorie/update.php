<?php

require_once 'db.php';
require_once 'header.php';
require_once 'index.php';



if (isset($_GET["id"])) {

  $id = htmlentities($_GET['id']);

  $sql = "SELECT * FROM categorie WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $row['name'];
    $image  = $row['image'];
  
  }
}

if (isset($_POST['edit'])) {

  $fileName       = $_FILES['file']['name'];
  $temp_name  = $_FILES['file']['tmp_name'];
  $location = 'photos';
  $targetFilePath = $location . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');


  if (in_array($fileType, $allowTypes)) {

    if (isset($fileName) and !empty($fileName)) {
      if (move_uploaded_file($temp_name, $targetFilePath)) {

        $name =  htmlspecialchars($_POST["name"]);
        $image =  htmlspecialchars($_POST["image"]);
        $id   = htmlentities($_POST['id']);

        $sql = "UPDATE categorie SET name = :name,  image=:fileName WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name',  $name);
        $stmt->bindParam(':fileName',  $fileName);
        $stmt->bindParam(':id',  $id);
        $stmt->execute();
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
      }
    } else {
      echo 'You should select a file to upload !!';
    }
  } else {
    echo 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
  }
} else {
  echo 'You cant leave field empty';
}

?>



<form action="#" method="POST" enctype="multipart/form-data">
  <div class="create">
    <h1> Update </h1>
    <input name="name" type="text" placeholder="Ange namn" class="input " value="<?php echo $name ?>">
    <input type="file" name="file">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="edit" value="Uppdatera" class="button">
  </div>

</form>

<?php
require_once 'footer.php';
?>