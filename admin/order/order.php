
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body class="order-bg">
<?php 

    require_once '../includes/db.php';
    $id = $_GET['id'];

    # DEN VACKRASTE OCH SNYGGASTE SQL QUERYN DU NÅGONSIN KOMMER LÄSA >>>
    $sql = 
    "SELECT 
    orders.*, orders.name AS order_name, 
    products.*, products.name AS prod_name, 
    ordered_products.order_id AS order_id, 
    ordered_products.product_id, ordered_products.quantity
    FROM orders, ordered_products, products 
    WHERE order_id = :id 
    AND orders.ID = :id 
    AND products.ID = ordered_products.product_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $products = '';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $orderID = htmlspecialchars($row["order_id"]);
        $status = htmlspecialchars($row["status"]);
        $date = htmlspecialchars($row['date']);
        $total = htmlspecialchars($row['total']);
        $city = htmlspecialchars($row['city']);
        $name = htmlspecialchars($row['order_name']);
        $adress = htmlspecialchars($row['adress']);
        $zip = htmlspecialchars($row['zip']);
        $phone = htmlspecialchars($row['phone']);
        $mail = htmlspecialchars($row['mail']);
        $prodName = htmlspecialchars($row['prod_name']);
        $prodImg = htmlspecialchars($row['image']);
        $prodQty = htmlspecialchars($row['quantity']);
        $products .= 
                    "<div class='product-wrap'>
                        <div class='product-img-wrap'>
                            <img src='../images/$prodImg' />
                        </div>
                        <div class='product-text-wrap'>
                            <div class='product-name'><span>Product:</span> <span>$prodName</span></div>
                            <div class='product-qty'><span>Quantity:</span> <span>$prodQty</span></div>
                        </div>
                    </div>";
    }
    echo "<section class='order-card'>
        <article class='order-card__customer'>
            <div class='order-card__item'><span>Order ID:    </span><span>$orderID</span></div>
            <div class='order-card__item'><span>Date:        </span><span>$date</span></div>
            <div class='order-card__item'><span>Total:       </span><span>$total €</span></div>
            <div class='order-card__item'><span>Name:        </span><span>$name</span></div>
            <div class='order-card__item'><span>Adress:      </span><span>$adress</span></div>
            <div class='order-card__item'><span>City:        </span><span>$city</span></div>
            <div class='order-card__item'><span>Zipcode:     </span><span>$zip</span></div>
            <div class='order-card__item'><span>E-mail:     </span><span>$mail</span></div>
            <div class='order-card__item'><span>Phone number:</span><span>$phone</span></div>
        </article>
        <article class='order-card__products'>
        <h1>Products</h1>
        $products
        </article>
        <a href='./orders.php'>Back to orders</a>
    </section>";

    
?>
</body>