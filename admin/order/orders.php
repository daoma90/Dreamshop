<?php 

function drawOrders($db) {
    $orders = "";

    while ($row = $db->fetch(PDO::FETCH_ASSOC)) {

        $orderID = htmlspecialchars($row["ID"]);
        $status = htmlspecialchars($row["status"]);
        $date = htmlspecialchars($row['date']);
        $total = htmlspecialchars($row['total']);
        $city = htmlspecialchars($row['city']);
        $name = htmlspecialchars($row['name']);

        $selected = "<select onchange='updateOrder($orderID, event)'>
                        <option " . ($status == "new" ? "selected" : NULL) . " value='new'>New</option>
                        <option " . ($status == "processing" ? "selected" : NULL) . " value='processing'>Processing</option>
                        <option " . ($status == "complete" ? "selected" : NULL) . " value='complete'>Complete</option>
                     </select>";

        $orders .= "
                    <tr class='display-status status-$status'>
                        <td class='order-clickable' onclick='test($orderID)'>$orderID</td>
                        <input type='hidden' name='id' value='$orderID'>
                        <td>$name</td>
                        <td>$date</td>
                        <td>$total</td>
                        <td class='city'>$city</td>
                        <td>$selected</td>
                    </tr>
                ";
    }
    $orders .= "</table>";
    echo $orders;
}

?>

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
    <div class="orders__status">
                    <span>Filter: </span>
                    <button onclick="showRelevantStatus(event)">All</button>
                    <button onclick="showRelevantStatus(event)">New</button>
                    <button onclick="showRelevantStatus(event)">Processing</button>
                    <button onclick="showRelevantStatus(event)">Complete</button>
                    <input placeholder="Search city" onkeyup="searchFilter(event)" type="text">
                </div>
    <table class="orders" id="order-uncomplete">
        <tr>
            <th>Order ID</th>
            <th>Name</th>
            <th onclick="sortTable(2, 'order-uncomplete')">Date</th>
            <th onclick="sortTable(3, 'order-uncomplete')">Total (€)</th>
            <th>City</th>
            <th onclick="sortTableStatus(5, 'order-uncomplete')">
            Status
            </th>
        </tr>
        <?php

        $sql = "SELECT * FROM orders WHERE status <> 'complete'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        drawOrders($stmt);

        ?>

    <h2 class="order-wrap__heading secondary">Completed orders:</h2>
    <table class="orders" id="order-complete">
        <tr>
            <th>Order ID</th>
            <th>Name</th>
            <th onclick="sortTable(2, 'order-complete')">Date</th>
            <th onclick="sortTable(3, 'order-complete')">Total (kr)</th>
            <th>City</th>
            <th onclick="sortTableStatus(5, 'order-complete')">
            Status
            </th>
        </tr>
            <?php

            $sql = "SELECT * FROM orders WHERE status = 'complete'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            drawOrders($stmt);
            ?>
            </div>
        </section>

    <script src="../js/header.js"></script>
    <script src="../js/ajax-orders.js"></script>
   </body>