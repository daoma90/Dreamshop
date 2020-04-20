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
    <?php
  require_once "./header.php"
  ?>
    <main>
      <div class="cont">
        <div class="products">
          <h2 class="products__headline">Your Order</h2>
          <div class="products__container"></div>
          <div class="products__completion-btns">
            <div class="products__total-wrap">
              <div class="products__total-text">TOTAL:</div>
              <div class="products__total">0</div>
            </div>
            <button class="products__clear">
              CLEAR
            </button>
            <a class="products__checkout" href="confirmation.html">ORDER</a>
          </div>
        </div>
        <div class="form-container">
          <form action="#" class="orderform">
            <label for="name" class="orderform__name-label">Name</label>
            <input type="text" name="name" class="orderform__input-name" />

            <label for="e-mail" class="orderform__name-label">E-Mail</label>
            <input type="text" name="e-mail" class="orderform__input-mail" />

            <label for="phone" class="orderform__name-label">Phone</label>
            <input type="text" name="phone" class="orderform__input-phone" />

            <label for="adress" class="orderform__name-label">Adress</label>
            <input type="text" name="adress" class="orderform__input-adress" />

            <label for="zip" class="orderform__name-label">Zip</label>
            <input type="text" name="zip" class="orderform__input-zip" />

            <label for="city" class="orderform__name-label">City</label>
            <input type="text" name="city" class="orderform__input-city" />

            <input type="submit" value="Order" />
          </form>
        </div>
      </div>
    </main>
    <?php
  require_once "./footer.php"
  ?>

    <script src="./assets/js/happyLib.js"></script>
    <script src="./assets/js/header.js"></script>
    <script src="./assets/js/cart.js"></script>
    <script src="./assets/js/order.js"></script>
    <script src="./assets/js/ajax-categories.js"></script>
  </body>
</html>
