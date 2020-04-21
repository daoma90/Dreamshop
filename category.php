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
        <h2 id="category" class="lp-products__current-category"><?= isset($_GET['category']) ? $_GET['category'] : "All shoes";?></h2>
        <div class="lp-products__wrap">
            <?php 
            if (isset($_GET['category'])){
                $sql = "SELECT * FROM category, products WHERE category.ID = products.cat_id AND category.name = :catName";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':catName', $_GET['category']);
                $stmt->execute();
            }
            else {
                $sql = "SELECT * FROM products";
                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
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