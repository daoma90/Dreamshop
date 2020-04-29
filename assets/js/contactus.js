const btn = document.getElementsByClassName("contact__button")[0];

btn.addEventListener("click", function (e) {
  e.preventDefault();

  validateName();
  validateEmail();
  validateMessage();

  console.log(validateMessage());

  if (validateName() && validateEmail() && validateMessage()) {
    const flip = document.getElementsByClassName("flip-card__inner")[0];
    const front = document.getElementsByClassName("flip-card__front")[0];
    const back = document.getElementsByClassName("flip-card__back")[0];
    if (isIE()) {
      front.style.visibility = "hidden";
      back.style.transform = "rotateY(0)";
    } else {
      flip.style.transform = "rotateY(-180deg)";
    }
    messageField.value = "";
  }
});

const nameField = document.querySelector("input[name='name']");
const nameError = document.getElementById("name-error");
const emailField = document.querySelector("input[name='email']");
const emailError = document.getElementById("email-error");
const messageField = document.querySelector("textarea");
const messageError = document.getElementById("message-error");

function validateName() {
  if (nameField.value == "") {
    nameError.style.visibility = "visible";
    nameField.style.border = "solid 3px red";
    return false;
  } else {
    nameError.style.visibility = "hidden";
    nameField.style.border = "solid 3px transparent";
    return true;
  }
}

function validateEmail() {
  const emailValidation = /\S+@\S+\.\S+/;
  if (!emailValidation.test(emailField.value)) {
    emailError.style.visibility = "visible";
    emailField.style.border = "solid 3px red";
    return false;
  } else {
    emailError.style.visibility = "hidden";
    emailField.style.border = "solid 3px transparent";
    return true;
  }
}

function validateMessage() {
  if (messageField.value == "") {
    messageError.style.visibility = "visible";
    messageField.style.border = "solid 3px red";
    return false;
  } else {
    messageError.style.visibility = "hidden";
    messageField.style.border = "solid 1px black";
    return true;
  }
}

function isIE() {
  userAgent = navigator.userAgent;
  var isIE =
    userAgent.indexOf("MSIE ") > -1 || userAgent.indexOf("Trident/") > -1;
  return isIE;
}