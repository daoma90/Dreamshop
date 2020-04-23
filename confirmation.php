<?php


require "/admin/includes/db.php";
//require "/assets/php/db.php";

if(isset($_GET["id"])){
   
    $sql = "SELECT * FROM order where :id=id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $categories = "";
    echo $categories;

      

//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//         $id = htmlspecialchars($row["id"]);
//         $name = htmlspecialchars($row["name"]);
//         $mail = htmlspecialchars($row["mail"]);
//         $phone = htmlspecialchars($row['adress']);
//         $zip = htmlspecialchars($row['zip']);
//         $city = htmlspecialchars($row['city']);
//         $total = htmlspecialchars($row['total']);

//         .= `<div ="container">

//        <div> ordnummer:$name</div>
//         <div>$name</div>
//         <div>$mail</div>
//         <div> $phone</div>
//         <div> $zip</div>
//         <div>$city</div>
//         <div> $total</div>
        
        
//           </div>`;
        
//    }


}


?>