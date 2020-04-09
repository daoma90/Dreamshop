const burger = document.querySelector(".header__nav");

burger.addEventListener("click", () => {
  if (burger.className.indexOf("active") === -1) {
    burger.classList.add("header__nav--active");
  } else {
    burger.classList.remove("header__nav--active");
  }
});
