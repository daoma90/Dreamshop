<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="container">

<div class="wrapper"></div>
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
        $date = htmlspecialchars($row['date']);

        $categories .= "
        <div>Order ID:$id</div>
        <div>$name</div>
        <div>$mail</div>
        <div>$phone</div>
        <div>$zip</div>
        <div>$city</div>
        <div>TOTAL: $total</div>
        <div>$date</div>
        <a href='./'>Back to shop</a>";
        
   }
   echo $categories;
}

?>
</div>
<script src="./assets/js/confirmation.js"></script>

</body>
</html>