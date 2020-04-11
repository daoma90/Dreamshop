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
    <?php require_once 'header.php';?>
    <section class="lp-hero">
        <div class="scroller">
            <div class="lp-hero__img-wrap"><img class="lp-hero__img" src="https://source.unsplash.com/random/1920x1080" alt=""></div>
            <div class="lp-hero__img-wrap"><img class="lp-hero__img" src="https://source.unsplash.com/random/1920x1050" alt=""></div>
            <div class="lp-hero__img-wrap"><img class="lp-hero__img" src="https://source.unsplash.com/random/1920x1020" alt=""></div>
        </div>
        <div class="lp-hero__btn-wrap">
            <h1 class="lp-hero__title">Summer Flavours</h1>
        </div>
        <button id="left"><i class="fa fa-arrow-left"></i></button>
        <button id="right"><i class="fa fa-arrow-right"></i></button>


    </section>
    <section class="feature-cards">
        <article class="feature-cards__card feature-cards__card--first"><div class="feature-cards__title"><span class="feature-cards__text feature-cards__text--left">- "Well done is better than well said."</span></div></article>
        <article class="feature-cards__card feature-cards__card--second"><div class="feature-cards__title"><span class="feature-cards__text feature-cards__text--right">- "The secret of getting ahead is getting started."</span></div></article>
    </section>

    <section class="feature-products">
        <h2 class="feature-products__title">Featured</h2>
        <div class="feature-products__product-wrap">
        <?php 
        $sql = "SELECT * FROM products WHERE featured = 1";
        require './assets/php/products.php'; 
        ?>
        </div>
    </section>

    <section class="lp-categories">
        <?php 
        require './assets/php/categories.php';
        ?>
    </section>

    <section class="lp-products">
        <h2 class="lp-products__current-category">All shoes</h2>
        <div class="lp-products__wrap">
            <?php 
            $sql = "SELECT * FROM products";
            require './assets/php/products.php';
            ?>
        </div>
    </section>

    <script src="./assets/js/happyLib.js"></script>
    <script src="./assets/js/cart.js"></script>
    <script src="./assets/js/header.js"></script>
    <script src="./assets/js/hero-scroller.js"></script>
    <script src="./assets/js/ajax-categories.js"></script>
</body>
</html>