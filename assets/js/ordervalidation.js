document.addEventListener('DOMContentLoaded', function () {
  let name = document.querySelector('.form-wrapper__input');
  let form = document.querySelector('.form-wrapper__form');
  let error = document.querySelector('.error');
  let mailError = document.querySelector('.error1');
  let mail = document.querySelector('.mail');
  let mobile = document.querySelector('.mobile');
  let mobileError = document.querySelector('.mobileError');
  let adress = document.querySelector('.adress');
  let adressError = document.querySelector('.adressError');
  let zipCode = document.querySelector('.zip');
  let zipError = document.querySelector('.zipError');
  let city = document.querySelector('.city');
  let cityError = document.querySelector('.cityError');
  let input = document.querySelectorAll('.form-wrapper__input');

  input.forEach(function (item) {
    item.addEventListener('input', function () {
      switch (item.getAttribute('name')) {
        case 'name':
          validName();
          break;
        case 'email':
          validateEmail();
          break;
        case 'phone':
          validPhone();
          break;
        case 'adress':
          validateAdress();
          break;
        case 'zip':
          validateZipCode();
          break;
        case 'city':
          validateCity();
          break;
      }
      isValidated();
    });
  });

  function isValidated() {
    if (
      validName() &&
      validateEmail() &&
      validPhone() &&
      validateAdress() &&
      validateZipCode() &&
      validateCity() &&
      cart.products.length > 0
    ) {
      document.querySelector('.form-wrapper__checkout').outerHTML =
        '<button type="submit" value="ORDER" class="form-wrapper__checkout" name="addOrder">ORDER</button>';
    } else {
      document.querySelector('.form-wrapper__checkout').outerHTML =
        '<div style="background: gray; cursor: auto" value="ORDER" class="form-wrapper__checkout" name="addOrder">ORDER</div>';
    }
  }

  function validName(e) {
    if (name.value.length <= 1) {
      error.textContent = 'Name must contain 2 Character';
      error.style.visibility = 'visible';
      error.style.color = 'red';
      return false;
    }
    error.style.visibility = 'hidden';
    return true;
  }

  function validateEmail(e) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value)) {
      mailError.style.visibility = 'hidden';
      return true;
    }
    mailError.textContent = 'Invalid email address format!';
    mailError.style.color = 'red';
    mailError.style.visibility = 'visible';
    return false;
  }

  function validPhone(e) {
    mobileError.style.visibility = 'hidden';
    if (isNaN(mobile.value)) {
      mobileError.textContent = 'Letters not allowed';
      mobileError.style.visibility = 'visible';
      mobileError.style.color = 'red';
      return false;
    } else if (mobile.value.length <= 9 || mobile.value.length >= 12) {
      mobileError.textContent = 'Minimum 10 Digits';
      mobileError.style.visibility = 'visible';
      mobileError.style.color = 'red';
      return false;
    }
    mobileError.style.visibility = 'hidden';
    return true;
  }

  function validateAdress(e) {
    if (adress.value.length <= 3) {
      adressError.textContent = ' Address must contain 2 Character';
      adressError.style.visibility = 'visible';
      adressError.style.color = 'red';
      return false;
    }
    adressError.style.visibility = 'hidden';
    return true;
  }

  function validateZipCode(e) {
    if (zipCode.value.length <= 4) {
      zipError.textContent = ' Invalid Zip';
      mailError.style.color = 'red';
      zipError.style.visibility = 'visible';
      zipError.style.color = 'red';
      return false;
    }
    zipError.style.visibility = 'hidden';
    return true;
  }

  function validateCity(e) {
    if (city.value.length <= 3 || city.value.length >= 20) {
      cityError.textContent = 'Invalid city name!';
      mailError.style.color = 'red';
      cityError.style.visibility = 'visible';
      cityError.style.color = 'red';
      return false;
    }
    cityError.style.visibility = 'hidden';
    return true;
  }
});
