<?php
//session_start();

include 'productGlobal.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <?php require_once "../includes/header.php"; ?>
    <main>

        <!-- Handles add and update post -->
        <section class="f-container">
            <form class='f-container__form' method='POST' action="productCreate.php" enctype='multipart/form-data'>
                <h3 class="f-container__form-header">Add new product</h3>
                <label for='image'>
                    <img class="f-container__form-preview" src="" alt="">
                    <span class="f-container__form-label">Choose image</span>
                    <input type='file' name='image' id='image'>
                </label>
                <label for='name'>
                    <span class="f-container__form-label">Name</span>
                    <br><input name='name' type='text'></label>
                <label for='description'><span class="f-container__form-label">Description:</span>
                    <textarea name='description' id='' cols='30' rows='2'></textarea>
                </label>
                <label for='price'><span class="f-container__form-label">Price</span>
                    <input name='price' type='text'></label>
                <label for='cat_id'><span class="f-container__form-label">Category</span>
                    <!-- Draws all available categorys -->
                    <?php getCatList($pdo); ?></label>
                    <!-- Draws all available categorys -->
                <label for='in_stock'><span class="f-container__form-label">Instock</span>
                    <input name='in_stock' type='text'></label>
                <label for='featured'><span class="f-container__form-label">Featured</span>
                    <input name='featured' type='text'></label>
                <input type="hidden" id="upID" name="update-id">
                <button class='f-container__form-submit' type='submit' name="addProduct">Save post</button>
                <i class="fa fa-times-circle" id="form-toggle" aria-hidden="true"></i>
            </form>
        </section>

        <!-- Draws all products-->
        <section class="section-products">
            <?php drawProducts($pdo); ?>
        </section>
        

    </main>
    <script src="../js/admin-products.js"></script>
    <script src="../js/header.js"></script>
</body>

</html>