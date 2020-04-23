<?php
  require_once "../includes/db.php";

  if (isset($_POST['addOrder'])) {
    $name = trim($_POST['name']);
    $mail = trim($_POST['mail']);
    $phone = trim($_POST['phone']);
    $adress = trim($_POST['adress']);
    $zip = trim($_POST['zip']);
    $zip = preg_replace('/\s+/', '', $zip);
    $city = trim($_POST['city']);
    $products = $_POST['products'];
    $quantity = $_POST['quantity'];
    $delivery = 50;
    $total = 0;

    $sql = "SELECT * FROM products WHERE ID IN (".implode(",", $products).")";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $total += $row['price'] * $quantity[$i];
      $i++;
    }

    if ($city == 'Stockholm' || $total >= 500) {
      $delivery = 0;
    }

    $total += $delivery;

    $sql = "INSERT INTO orders(name,mail,phone,adress,zip,city,total,delivery_fee) VALUES(:name,:mail,:phone,:adress,:zip,:city,:total,:delivery_fee);";

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

      $redirectID = $pdo->lastInsertId();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();

    }

    $sql = "INSERT INTO ordered_products (product_id, order_id, quantity) VALUES ";
    
    foreach ($products as $key => $value) {
      if ($key != count($products) - 1){
        $sql .= "($value, LAST_INSERT_ID(), $quantity[$key]), ";
      }
      else {
        $sql .= "($value, LAST_INSERT_ID(), $quantity[$key]); ";
      }
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
   
    header("Location:../../confirmation.php?orderID=" . $redirectID);
   
  };
    
?>