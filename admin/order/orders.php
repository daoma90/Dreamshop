<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body class ="orders-bg">
    <?php
    require_once "../includes/db.php";
    require_once "../includes/header.php";
    ?>
    <section class="order-wrap">
    <h1 class="order-wrap__heading">Orders:</h1>
    <div class="order-wrap__table-wrapper">
    <table class="orders" id="order-uncomplete">
        <tr>
            <th>Order ID</th>
            <th onclick="sortTable(1, 'order-uncomplete')">Date</th>
            <th onclick="sortTable(2, 'order-uncomplete')">Total</th>
            <th>City</th>
            <th onclick="sortTableStatus(4, 'order-uncomplete')">Status</th>
        </tr>
        <?php

        $sql = "SELECT * FROM orders WHERE status <> 'complete'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $orders = "";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $orderID = htmlspecialchars($row["ID"]);
            $status = htmlspecialchars($row["status"]);
            $date = htmlspecialchars($row['date']);
            $total = htmlspecialchars($row['total']);
            $city = htmlspecialchars($row['city']);

            $selected = "<select onchange='updateOrder($orderID, event)'>
                            <option " . ($status == "new" ? "selected" : NULL) . " value='new'>New</option>
                            <option " . ($status == "processing" ? "selected" : NULL) . " value='processing'>Processing</option>
                            <option " . ($status == "complete" ? "selected" : NULL) . " value='complete'>Complete</option>
                         </select>";

            $orders .= "
                        <tr'>
                            <td>$orderID</td>
                            <input type='hidden' name='id' value='$orderID'>
                            <td>$date</td>
                            <td>$total</td>
                            <td>$city</td>
                            <td>$selected</td>
                        </tr>
                    ";
        }
        $orders .= "</table>";
        echo $orders;
        ?>

    <h2 class="order-wrap__heading secondary">Completed orders:</h2>
    <table class="orders" id="order-complete">
            <tr>
                <th>Order ID</th>
                <th onclick="sortTable(1, 'order-complete')">Date</th>
                <th onclick="sortTable(2, 'order-complete')">Total</th>
                <th>City</th> 
                <th>Status</th> 
            </tr>
            <?php

            $sql = "SELECT * FROM orders WHERE status = 'complete'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $orders = "";
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    
                $orderID = htmlspecialchars($row["ID"]);
                $status = htmlspecialchars($row["status"]);
                $date = htmlspecialchars($row['date']);
                $total = htmlspecialchars($row['total']);
                $city = htmlspecialchars($row['city']);
    
                $selected = "<select onchange='updateOrder($orderID, event)'>
                                <option " . ($status == "new" ? "selected" : NULL) . " value='new'>New</option>
                                <option " . ($status == "processing" ? "selected" : NULL) . " value='processing'>Processing</option>
                                <option " . ($status == "complete" ? "selected" : NULL) . " value='complete'>Complete</option>
                             </select>";
    
                $orders .= "
                            <tr>
                                <td>$orderID</td>
                                <input type='hidden' name='id' value='$orderID'>
                                <td>$date</td>
                                <td>$total</td>
                                <td>$city</td>
                                <td>$selected</td>
                            </tr>
                        ";
            }
            $orders .= "</table>";
            echo $orders;
            ?>
            </div>
        </section>

    <script src="../js/header.js"></script>
    <script src="../js/ajax-orders.js"></script>
   </body>