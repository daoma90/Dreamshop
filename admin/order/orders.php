<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
    <?php
    require_once "../includes/db.php";
    require_once "../includes/header.php";
    ?>
    <section class="order-wrap">
    <h1 class="order-wrap__heading">Orders:</h1>

    <table class="orders">
        <tr>
            <th>Order ID</th>
            <th>Status</th> 
            <th>Date</th>
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

            $selected = "<select onchange='updateOrder($orderID, event)'>
                            <option " . ($status == "new" ? "selected" : NULL) . " value='new'>New</option>
                            <option " . ($status == "processing" ? "selected" : NULL) . " value='processing'>Processing</option>
                            <option " . ($status == "complete" ? "selected" : NULL) . " value='complete'>Complete</option>
                         </select>";

            $orders .= "
                        <tr>
                            <td>$orderID</td>
                            <input type='hidden' name='id' value='$orderID'>
                            <td>$selected</td>
                            <td>$date</td>
                        </tr>
                    ";
        }
        $orders .= "</table>";
        echo $orders;
        ?>

    <h2 class="order-wrap__heading secondary">Completed orders:</h2>
    <table class="orders">
            <tr>
                <th>Order ID</th>
                <th>Status</th> 
                <th>Date</th>
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
    
                $selected = "<select onchange='updateOrder($orderID, event)'>
                                <option " . ($status == "new" ? "selected" : NULL) . " value='new'>New</option>
                                <option " . ($status == "processing" ? "selected" : NULL) . " value='processing'>Processing</option>
                                <option " . ($status == "complete" ? "selected" : NULL) . " value='complete'>Complete</option>
                             </select>";
    
                $orders .= "
                            <tr>
                                <td>$orderID</td>
                                <input type='hidden' name='id' value='$orderID'>
                                <td>$selected</td>
                                <td>$date</td>
                            </tr>
                        ";
            }
            $orders .= "</table>";
            echo $orders;
            ?>
        </section>

    <script src="../js/header.js"></script>
    <script src="../js/ajax-orders.js"></script>
   </body>