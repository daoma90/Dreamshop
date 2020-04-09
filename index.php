<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="./assets/style/main.css">
</head>
<body>
    <section class="feature-cards">
        <article class="feature-cards__card feature-cards__card--first"><div class="feature-cards__title">Inspirational quote</div></article>
        <article class="feature-cards__card feature-cards__card--second"><div class="feature-cards__title">Inspirational quote</div></article>
    </section>

    <section class="feature-products">
        <h2 class="feature-products__title">Featured</h2>
        <div class="feature-products__product-wrap">
        <!-- RENDER PRODUCTS FROM DATABASE -->
            <article class="feature-products__product">
                <img class="feature-products__img" src="./assets/media/placeholder-shoe.jpg" alt="">
                <div class="feature-products__product-title">Nike AirMax</div>
                <div class="feature-products__price">1800kr</div> 
            </article>
            <article class="feature-products__product">
                <img class="feature-products__img" src="./assets/media/placeholder-shoe.jpg" alt="">
                <div class="feature-products__product-title">Nike AirMax</div>
                <div class="feature-products__price">1800kr</div> 
            </article>
            <article class="feature-products__product">
                <img class="feature-products__img" src="./assets/media/placeholder-shoe.jpg" alt="">
                <div class="feature-products__product-title">Nike AirMax</div>
                <div class="feature-products__price">1800kr</div> 
            </article>
        <!-- RENDER PRODUCTS FROM DATABASE -->
        </div>
    </section>

    <section class="lp-categories">
        <!-- RENDER CATEGORIES FROM DATABASE -->
        <article class="lp-categories__item">
            <img class="lp-categories__img" src="" alt="">
            <div class="lp-categories__title">RUNNING</div>
        </article>
         <!-- RENDER CATEGORIES FROM DATABASE -->
    </section>

    <section class="lp-products">
        <article class="lp-products__product">
            <img class="lp-products__img" src="./assets/media/placeholder-shoe.jpg" alt="">
            <div class="lp-products__product-title">1800kr</div>
            <div class="lp-products__price">1800kr</div>
        </article>
    </section>

</body>
</html>