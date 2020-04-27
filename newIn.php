<?php 
    require_once './assets/php/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="./assets/style/main.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
</head>
<body>
<?php require_once 'header.php'; ?>
<section class="lp-products">
        <h2 class="lp-products__current-category">New in</h2>
        <div class="lp-products__wrap">
            <?php 
                $sql = "SELECT * FROM products WHERE created_at > (NOW() - INTERVAL 2 DAY)";
                $stmt = $db->prepare($sql);
                $stmt->execute();

            require './assets/php/products.php';
            ?>
        </div>
    </section>

    <?php require_once 'footer.php' ?>
    <script src="./assets/js/happyLib.js"></script>
    <script src="./assets/js/header.js"></script>
    <script src="./assets/js/cart.js"></script>
</body>
</html>