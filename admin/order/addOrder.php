<?php
  require_once "../includes/db.php";

  if (isset($_POST['addOrder'])) {
    $name = trim($_POST['name']);
    $mail = trim($_POST['mail']);
    $phone = trim($_POST['phone']);
    $adress = trim($_POST['adress']);
    $zip = trim($_POST['zip']);
    $city = trim($_POST['city']);
    $price = trim($_POST['price']);
    $delivery = 50;

    if ($city == 'Stockholm' || $price >= 50) {
      $delivery = 0;
    }

    $total = ($price - $delivery);


    $sql = "INSERT INTO orders(name,mail,phone,adress,zip,city,total,delivery_fee) VALUES(:name,:mail,:phone,:adress,:zip,:city,:total,:delivery_fee)";
    $stmt = $pdo->prepare($sql);
    try {
    $stmt->execute([
      ':name' => $name,
      ':mail' => $mail,
      ':phone' => $phone,
      ':adress' => $adress,
      ':zip' => $zip,
      ':city' => $city,
      ':total' => $total,
      ':delivery_fee' => $delivery
      ]);

      header("Location:/confirmation.php?orderID=" . $pdo->lastInsertId());

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();

    }
      
    };
    
  

?>