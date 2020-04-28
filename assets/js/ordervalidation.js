let name = document.querySelector(".form-wrapper__input")
let form = document.querySelector(".form-wrapper__form")
let error = document.querySelector(".error")
let mailError = document.querySelector(".error1")
let input = document.querySelectorAll("input")
let mail = document.querySelector(".mail")
let mobile = document.querySelector(".mobile")
let mobileError = document.querySelector(".mobileError")
let adress = document.querySelector(".adress")
let adressError = document.querySelector(".adressError")
let zipCode = document.querySelector(".zip")
let zipError = document.querySelector(".zipError")
let city = document.querySelector(".city")
let cityError = document.querySelector(".cityError")




const btn = document.querySelector(".form-wrapper__checkout")
btn.addEventListener("click", function (e) {
    e.preventDefault();

    validname(e)
    validPhone(e)
    validateAdress(e)
    validateZipCode(e)
    validateCity(e)
    ValidateEmail(e)
})

// for (let i = 0; i < input.length; i++) {
//     const inputs = input[i];

//     inputs.addEventListener("input", function (e) {

//         validname(e)
//         validPhone(e)
//         validateAdress(e)
//         validateZipCode(e)
//         validateCity(e)
//         ValidateEmail(e)
//     })
// }

function validname(e) {
    if (name.value.length <= 1) {
        error.textContent = "Name must contain 2 Character";
        error.style.visibility = "visible";
        error.style.color = "red"
        return (false)
    }
    error.style.visibility = "hidden";
    return (true)
}


function ValidateEmail(e) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value)) {
        mailError.style.visibility = "hidden";
        return (true)
    }
    mailError.textContent = "You have entered an invalid email address!"
    mailError.style.color = "red"
    mailError.style.visibility = "visible";
    return (false)
}


function validPhone(e) {
    mobileError.style.visibility = "hidden";
    if (mobile.value.length <= 10 || isNaN(mobile.value)) {
        mobileError.textContent = "Phone Number must contain 10 Character"
        mobileError.style.visibility = "visible";
        mobileError.style.color = "red"
        return (false)
    }
    mobileError.style.visibility = "hidden";
    return (true)
}

function validateAdress(e) {
    if (adress.value.length <= 3) {
        adressError.textContent = " Adrres must contain 2 Character"
        adressError.style.visibility = "visible";
        adressError.style.color = "red"
        return (false)
    }
    adressError.style.visibility = "hidden";
    return (true)
}


function validateZipCode(e) {
    if (zipCode.value.length <= 3) {
        zipError.textContent = " invalid ZipCode"
        mailError.style.color = "red"
        zipError.style.visibility = "visible";
        zipError.style.color = "red"
        return (false)
    }
    zipError.style.visibility = "hidden";
    return (true)
}


function validateCity(e) {
    if (city.value.length <= 3 || city.value.length >= 20) {
        cityError.textContent = "invalid City name!"
        mailError.style.color = "red"
        cityError.style.visibility = "visible";
        cityError.style.color = "red"
        return (false)
    }
    cityError.style.visibility = "hidden";
    return (true)
}