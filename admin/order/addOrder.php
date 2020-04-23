<?php
  require_once "../includes/db.php";

  if (isset($_POST['addOrder'])) {
    

    /**
    * Gets order from form on order.php
    * Selects all products from products-db that is located in cart
    * Validates delivery fee based on city or total price
    * Inserts order in to orders database
    **/

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

    try {
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
        

      /**
      * Inserts the actual order to ordered_products database.
      **/

      $sql = "INSERT INTO ordered_products (product_id, order_id, quantity) VALUES ";
      
      foreach ($products as $key => $value) {
        if ($key != count($products) - 1){
          $sql .= "($value, LAST_INSERT_ID(), $quantity[$key]), ";
        } else {
          $sql .= "($value, LAST_INSERT_ID(), $quantity[$key]); ";
        }
      }
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      
    
      /**
      * Updates the in_stock in the products database.
      * Selects products where the product-ID is the same in ordered_products and products
      * Only does this on the last order in ordered_products
      **/

      $sql = "UPDATE products AS p
      JOIN ordered_products AS op ON p.id = op.product_id
      SET p.in_stock = p.in_stock - op.quantity
      WHERE op.order_id = " . $redirectID;
      echo "$sql";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
   
    header("Location:../../confirmation.php?orderID=" . $redirectID); 
?>