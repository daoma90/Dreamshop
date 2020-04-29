<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="assets/style/main.css" />
  </head>
  <body>
    <?php require_once "header.php" ?>
    <section class="contact">
      <div class="contact__background"></div>
      <form class="contact__form">
        <div class="flip-card">
          <div class="flip-card__inner">
            <div class="flip-card__front">
              <a href="../index.php" class="flip-card__close"></a>
              <h3 class="flip-card__headline">Contact us</h3>
              <div class="flip-card__front-form">
                <div class="flip-card__input-group">
                  <label class="flip-card__front-label" for="name">Name</label>
                  <input
                    class="flip-card__front-input"
                    type="text"
                    name="name"
                  />
                  <p class="form-error" id="name-error">
                    Fill in a name
                  </p>
                </div>
                <label class="flip-card__front-label" for="email"
                  >E-mail</label
                >
                <input
                  class="flip-card__front-input"
                  type="text"
                  name="email"
                />
                <p class="form-error" id="email-error">
                  Fill in a correct e-mail adress
                </p>
              </div>
              <div class="flip-card__info">
                <p class="flip-card__info-text">
                  Tomtebodavägen 3A <br />
                  123 45 Stockholm
                </p>
                <p class="flip-card__info-text">contactus@dreamshop.se</p>
                <p class="flip-card__info-text">+460000000</p>
              </div>
              <div class="flip-card__social">
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/facebook.png"
                /></a>
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/instagram.png"
                /></a>
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/twitter.png"
                /></a>
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/linkedin.png"
                /></a>
              </div>
            </div>
            <div class="flip-card__back">
              <a href="./index.php" class="flip-card__close"></a>
              <h3 class="flip-card__headline">
                Thank you for contacting us!
              </h3>
              <p class="flip-card__info-text">
                We will reach out to you as soon as possible.
              </p>
              <div class="flip-card__social">
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/facebook.png"
                /></a>
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/instagram.png"
                /></a>
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/twitter.png"
                /></a>
                <a href=""
                  ><img
                    class="flip-card__social-icon"
                    src="assets/media/linkedin.png"
                /></a>
              </div>
            </div>
          </div>
        </div>
        <div class="contact__message-box">
          <div class="contact__message-container">
            <label class="contact__message-label" for="message"
              >Message</label
            >
            <textarea class="contact__message" name="message"></textarea>
            <p class="form-error" id="message-error">Message required</p>
            <input type="submit" class="contact__button" value="Send" />
          </div>
        </div>
      </form>
    </section>
    <?php require_once "footer.php" ?>
    <script src="assets/js/contactus.js"></script>
    <script src="assets/js/header.js"></script>
  </body>
</html>
