<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php


require "./admin/includes/db.php";
//require "/assets/php/db.php";

if(isset($_GET["orderID"])){
   
    $sql = "SELECT * FROM orders where :id=id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id'=>$_GET['orderID']]);
    $categories = "";

      
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $id = htmlspecialchars($row["ID"]);
        $name = htmlspecialchars($row["name"]);
        $mail = htmlspecialchars($row["mail"]);
        $phone = htmlspecialchars($row['adress']);
        $zip = htmlspecialchars($row['zip']);
        $city = htmlspecialchars($row['city']);
        $total = htmlspecialchars($row['total']);

        $categories .= "<div class='container'>
        <div class='wrapper'></div>
        <div>$total</div>
        <div>ordnummer:$id</div>
        <div>$name</div>
        <div>$mail</div>
        <div>$phone</div>
        <div>$zip</div>
        <div>$city</div>
        <div>$total</div>
        <a href='./'>Back to shop</a></div>";
        
   }
   echo $categories;
}

?>
<script src="./assets/js/confirmation.js"></script>

</body>
</html>