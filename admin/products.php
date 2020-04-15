<?php
require_once 'db.php';
include 'productCurd.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="./assets/style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <?php require_once "header.php"; ?>
    <main>
        <!-- Handles add and update post -->
        <section class="form-container">
            <form class='form-container__form' method='POST' action="createproduct.php" enctype='multipart/form-data'>
                <h3 class="form-container__form-header">Add new product</h3>
                <label for='image'>
                    <img class="form-container__form-preview" src="" alt="">
                    <span class="form-container__form-label">Choose image</span>
                    <input type='file' name='image' id='image'>
                </label>
                <label for='name'>
                    <span class="form-container__form-label">Name</span>
                    <br><input name='name' type='text'></label>
                <label for='description'><span class="form-container__form-label">Description:</span>
                    <textarea name='description' id='' cols='30' rows='2'></textarea>
                </label>
                <label for='price'><span class="form-container__form-label">Price</span>
                    <input name='price' type='text'></label>
                <label for='cat_id'><span class="form-container__form-label">Category</span>
                    <!-- Draws all available categorys -->
                    <?php getCatList($pdo); ?></label>
                <label for='in_stock'><span class="form-container__form-label">Instock</span>
                    <input name='in_stock' type='text'></label>
                <label for='featured'><span class="form-container__form-label">Featured</span>
                    <input name='featured' type='text'></label>
                <input type="hidden" id="upID" name="update-id">
                <button class='form-container__form-submit' type='submit' name="addProduct">Save post</button>
            </form>
        </section>
        <!-- Draws all products-->
        <section class="section-main">
            <?php drawProducts($pdo); ?>
        </section>

   
    </main>
    <script src="./assets/js/admin-products.js"></script>
    <script src="./assets/js/header.js"></script>
</body>
</html>