<?php
//session_start();

include 'productGlobal.php';
ini_set('error_reporting', E_ALL);

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
        <section class="section-add">
            <div class="section-add-imgwrap"><img src="../media/add_2x.png" alt=""></div>
            <div class="view-bar" style="display:none;">
                <div class="view-bar view-bar__search">
                    <input id="srch" class="view-bar__search-input" type="text" value="search..." name="search">
                </div>
                <div class="view-bar view-bar__drop">
                    <select name="categorydrop" id="drop">
                        <option value="">Sort by category</option>
                        <option value="">category 1</option>
                        <option value="">category 1</option>
                        <option value="">category 1</option>
                    </select>
                </div>
            </div>
        </section>
        <!-- Draws all products with form-->
        <section class="section-products">
            <div class='product-form' style="display:none;">
                <form class='product-form-main' method='POST' action="productCreate.php" enctype='multipart/form-data'>
                    <div class='product-form-main__left'>
                        <div class="product-form-main__left-img"><img src="../media/img-placeholder.png" alt=""></div>
                        <input type='file' name='image[]' id='image' multiple>
                        <div class="product-form-main__left__gallery">
                         </div>
                         <p class="product-form-main__left-response" style="display:none"></p>
                    </div>
                    <div class='product-form-main__right'>
                        <h2 class="product-form-main__right-header">EDIT PRODUCT</h2>
                        <label for="name" class="product-form-main__right-label">NAME:</label>
                        <input name='name' type='text' required>
                        <label for="name" class="product-form-main__right-label">DESCRIPTION:</label>
                        <textarea name='description' id='' cols='30' rows='6' required></textarea>
                        <label for="name" class="product-form-main__right-label">PRICE:</label>
                        <input name='price' type='number' required>
                        <!-- Draws all available categorys -->
                        <label for="cat_id" class="product-form-main__right-label">CATEGORY:</label>
                        <?php getCatList($pdo); ?>
                        <!-- Draws all available categorys -->
                        <label for="in_stock" class="product-form-main__right-label">QUANTITY:</label>
                        <input name='in_stock' type='number' required>
                        <label for="featured" class="product-form-main__right-label">FEATURED:</label>
                        <select name="featured" id="feat">
                            <option name="featured" value="0">No</option>
                            <option name="featured" value="1">Yes</option>
                        </select>
                        <label for="is_old" class="product-form-main__right-label">ON SALE:</label>
                        <select name="is_old" id="is_old">
                            <option name="is_old" value="0">No</option>
                            <option name="is_old" value="1">Yes</option>
                        </select>
                        <input type="hidden" id="upID" name="update-id">
                        <button class='btn btn--done' type='submit' name="addProduct"></button>
                        <button class='btn btn--close' id="form-toggle" type="button"></button>
                    </div>
                </form>
            </div>
            <?php drawProducts($pdo); ?>
        </section>
    </main>
    <script src="../js/admin-products.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/alert.js"></script>
</body>

</html>