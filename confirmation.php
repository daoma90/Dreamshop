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

        <div>ordnummer:$id</div>
        <div>$name</div>
        <div>$mail</div>
        <div>$phone</div>
        <div>$zip</div>
        <div>$city</div>
        <div>$total</div>
        </div>
        <a href='./'>Back to shop</a>";
        
   }
   echo $categories;


}


?>