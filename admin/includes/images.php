<?php
function initImages($ID, $query, $param, $pdo) {
  $targetDir = "../images/";
  $allowTypes = array("jpg", "png", "jpeg", "gif");
  $fileNames = array_filter($_FILES["image"]["tmp_name"]);
    if (isset($ID)) {
        if (!empty($fileNames)) {
            foreach ($_FILES["image"]["name"] as $key => $val) {
                $fileName = basename($_FILES["image"]["name"][$key]);
                $targetDir = $targetDir . $fileName;
                // Check whether file type is valid
                $fileType = pathinfo($targetDir, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetDir)) {
                        $fileName = $_FILES["image"]["name"][$key];
                        $sql = $query;
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':image' => $fileName,
                            ':product_id' => $ID,
                        ]);
                    } else {
                    }
                } else {
                }
            }
        }
    }
}

?>
