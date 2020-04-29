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
    <?php require_once 'header.php'; ?>
    <section class="lp-hero">
        <div class="scroller">
            <div class="lp-hero__img-wrap"><img class="lp-hero__img" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt=""></div>
            <div class="lp-hero__img-wrap"><img class="lp-hero__img" src="https://images.unsplash.com/photo-1517466121016-3f7e7107c756?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt=""></div>
            <div class="lp-hero__img-wrap"><img class="lp-hero__img" src="https://images.unsplash.com/photo-1514989940723-e8e51635b782?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt=""></div>
        </div>
        <div class="lp-hero__btn-wrap">
            <h1 class="lp-hero__title">Summer Flavours</h1>
        </div>
        <button id="left"><i class="fa fa-arrow-left"></i></button>
        <button id="right"><i class="fa fa-arrow-right"></i></button>


    </section>
    <section class="feature-cards">
        <a class="feature-cards__card feature-cards__card--first" href="newIn.php">
            <article>
                <div class="feature-cards__title">
                    <span class="feature-cards__text feature-cards__text--left">Check out our newest products!</span>
                </div>
            </article>
        </a>
        <a class="feature-cards__card feature-cards__card--second" href="oldOut.php">
            <article>
                <div class="feature-cards__title"><span class="feature-cards__text feature-cards__text--right">Older products need to go. 10% off!</span></div>
            </article>
        </a>
    </section>

    <section class="feature-products">
        <h2 class="feature-products__title">Featured</h2>
        <div class="feature-products__product-wrap">
            <?php
            require './assets/php/featured-products.php';
            ?>
        </div>
    </section>

    <section class="lp-categories">
        <?php
        require './assets/php/categories.php';
        ?>
    </section>


    <?php require_once 'footer.php'; ?>

    <script src="./assets/js/happyLib.js"></script>
    <script src="./assets/js/header.js"></script>
    <script src="./assets/js/cart.js"></script>
    <script src="./assets/js/hero-scroller.js"></script>
    <script src="./assets/js/search.js"></script>
</body>

</html>