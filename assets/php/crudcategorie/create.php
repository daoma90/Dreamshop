<?php

require_once 'db.php';
require_once 'header.php';
require_once 'index.php';

$statusMsg = '';

// File upload path
$targetDir = "photos/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);



if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES["file"]["name"])) {

  $name =  htmlspecialchars($_POST["name"]);
 

  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
  if (in_array($fileType, $allowTypes)) {

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

      $sql = "INSERT INTO categorie(name, image) VALUES (:titel, :fileName)";
    //   echo $fileName;
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':titel',  $name);
      $stmt->bindParam(':fileName',  $fileName);
      $stmt->execute();

      echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
    } else {
      $statusMsg = "Sorry, there was an error uploading your file.";
    }
  } else {
    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
  }
} else {
  //echo 'empty';
}


?>


<form action="#" method="POST" enctype="multipart/form-data">
  <div class="create">
    <h1> Create </h1>
    <input name="name" type="text" placeholder="Ange kategorie " class="input">
    <input type="file" name="file">
    <input type="submit" value="Lägg till" class="button">
  </div>
</form>
<?php
require_once 'footer.php';
?>