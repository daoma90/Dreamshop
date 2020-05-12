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
    if (/[^a-zA-Z åäöÅÄÖ]/.test(name.value)) {
      error.textContent = 'Invalid characters';
      error.style.visibility = 'visible';
      error.style.color = 'red';
      return false;
    } else if (name.value.trim().length <= 1 || name.value.trim().length > 20) {
      error.textContent = 'Name must contain between 2-20 characters';
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
    mailError.textContent = 'Invalid email address format';
    mailError.style.color = 'red';
    mailError.style.visibility = 'visible';
    return false;
  }

  function validPhone(e) {
    mobileError.style.visibility = 'hidden';
    if (isNaN(mobile.value)) {
      mobileError.textContent = 'Only digits allowed';
      mobileError.style.visibility = 'visible';
      mobileError.style.color = 'red';
      return false;
    } else if (mobile.value.trim().length <= 9) {
      mobileError.textContent = 'Minimum 10 digits';
      mobileError.style.visibility = 'visible';
      mobileError.style.color = 'red';
      return false;
    }
    mobileError.style.visibility = 'hidden';
    return true;
  }

  function validateAdress(e) {
    if (/[^a-zA-Z0-9 åäöÅÄÖ]/.test(adress.value)) {
      adressError.textContent = 'Invalid characters';
      adressError.style.visibility = 'visible';
      adressError.style.color = 'red';
      return false;
    } else if (adress.value.trim().length <= 3) {
      adressError.textContent = 'Invalid address - too short';
      adressError.style.visibility = 'visible';
      adressError.style.color = 'red';
      return false;
    } else if (!/\d/.test(adress.value)) {
      adressError.textContent = 'Must have at least one digit';
      adressError.style.visibility = 'visible';
      adressError.style.color = 'red';
      return false;
    } else if (!/\D[^\s]/.test(adress.value)) {
      adressError.textContent = 'Must have at least one letter';
      adressError.style.visibility = 'visible';
      adressError.style.color = 'red';
      return false;
    }
    adressError.style.visibility = 'hidden';
    return true;
  }

  function validateZipCode(e) {

    //If we want to accept space
    // if(zipCode.value.includes(" ")) {
    //   zipCode.setAttribute("maxlength", "6");
    // } else {
    //   zipCode.setAttribute("maxlength", "5");
    // }

    if (
      isNaN(zipCode.value) ||
      zipCode.value.includes(' ') ||
      !/^[0-9]*$/.test(zipCode.value)
    ) {
      zipError.textContent = 'Invalid characters';
      zipError.style.visibility = 'visible';
      zipError.style.color = 'red';
      return false;
    } else if (zipCode.value.length <= 4) {
      zipError.textContent = 'Invalid zip - too short';
      zipError.style.visibility = 'visible';
      zipError.style.color = 'red';
      return false;
    }
    zipError.style.visibility = 'hidden';
    return true;
  }

  function validateCity(e) {
    if (/[^a-zA-Z åäöÅÄÖ]/.test(city.value)) {
      cityError.textContent = 'Invalid characters';
      cityError.style.visibility = 'visible';
      cityError.style.color = 'red';
      return false;
    } else if (
      city.value.trim().length <= 3 ||
      city.value.trim().length >= 20
    ) {
      cityError.textContent = 'Invalid city - too short';
      cityError.style.visibility = 'visible';
      cityError.style.color = 'red';
      return false;
    }
    cityError.style.visibility = 'hidden';
    return true;
  }
});
