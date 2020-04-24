<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Frontendprojekt</title>
    <link rel="stylesheet" href="assets/style/main.css" />
  </head>
  <body>
    <div class="background-container">
      <div class="background">
        <div class="background__image" id="image1"></div>
        <div class="background__image" id="image2"></div>
        <div class="background__image" id="image3"></div>
      </div>
    </div>
    <section class="contact">
      <form class="contact__form">
        <div class="flip-card">
          <div class="flip-card__inner">
            <div class="flip-card__front">
              <a href="../index.php" class="flip-card__close"></a>
              <h3 class="flip-card__headline">Kontakta oss</h3>
              <div class="flip-card__front-form">
                <div class="flip-card__input-group">
                  <label class="flip-card__front-label" for="name">Namn</label>
                  <input
                    class="flip-card__front-input"
                    type="text"
                    name="name"
                  />
                  <p class="form-error" id="name-error">
                    Fyll i ett namn
                  </p>
                </div>
                <label class="flip-card__front-label" for="email" required
                  >E-mail</label
                >
                <input
                  class="flip-card__front-input"
                  type="text"
                  name="email"
                />
                <p class="form-error" id="email-error">
                  Skriv in en korrekt email adress
                </p>
              </div>
              <div class="flip-card__info">
                <p class="flip-card__info-text">
                  Tomtebodavägen 3A <br />
                  123 45 Stockholm
                </p>
                <p class="flip-card__info-text">Dreamteam@dreamteam.se</p>
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
              <a href="../index.php" class="flip-card__close"></a>
              <h3 class="flip-card__headline">
                Tack för ditt meddelande!
              </h3>
              <p class="flip-card__info-text">
                Vi kommer att kontakta dig så snart som möjligt!
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
              >Meddelande</label
            >
            <textarea class="contact__message" name="message"></textarea>
            <p class="form-error" id="message-error">Skriv ett meddelande</p>
            <input type="submit" class="contact__button" value="Skicka" />
          </div>
        </div>
      </form>
    </section>
    <script src="assets/js/contactus.js"></script>
  </body>
</html>
