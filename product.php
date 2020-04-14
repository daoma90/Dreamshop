<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="./assets/style/main.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>

  <body>
    <?php include 'header.php';?>
    <main class="productpage-wrapper">
      <section class="productpage">
        <div class="productpage__col-left">
          <div class="productpage__primary-img-wrap">
            <img
              class="productpage__img productpage__img--large"
              src="./assets/media/placeholder-shoe.jpg"
              alt=""
            />
          </div>
          <div class="productpage__image-bar">
            <div class="productpage__img-wrap">
              <img
                class="productpage__img"
                src="./assets/media/placeholder-shoe.jpg"
                alt=""
              />
            </div>
            <div class="productpage__img-wrap">
              <img
                class="productpage__img"
                src="./assets/media/placeholder-shoe.jpg"
                alt=""
              />
            </div>
            <div class="productpage__img-wrap">
              <img
                class="productpage__img"
                src="./assets/media/placeholder-shoe.jpg"
                alt=""
              />
            </div>
            <div class="productpage__img-wrap">
              <img
                class="productpage__img"
                src="./assets/media/placeholder-shoe.jpg"
                alt=""
              />
            </div>
            <div class="productpage__img-wrap">
              <img
                class="productpage__img"
                src="./assets/media/placeholder-shoe.jpg"
                alt=""
              />
            </div>
          </div>
        </div>

        <div class="productpage__col-right">
          <div class="productpage__heading-wrap">
            <h1 class="productpage__name">Shoe Name</h1>
            <span class="productpage__price">999 SEK</span>
            <small class="productpage__category">Running</small>
          </div>
          <p class="productpage__desc">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita
            distinctio totam modi odit doloremque ea similique rerum aliquam
            laborum alias. Commodi id, vero numquam nostrum nihil soluta
            repellat doloremque pariatur?
          </p>
          <div class="productpage__input-wrap">
            <input class="productpage__qty" type="number" value="1" />
            <button class="productpage__add">ADD TO CART</button>
          </div>
        </div>
      </section>
    </main>
    <script src="./assets/js/happyLib.js"></script>
    <script src="./assets/js/header.js"></script>
    <script src="./assets/js/cart.js"></script>
  </body>
</html>
