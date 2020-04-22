<?php

$ID = $pdo->lastInsertId();
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
                    $sql = "INSERT INTO images(image, product_id) VALUES (:image,:product_id)";
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

?>
