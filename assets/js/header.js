const burger = document.querySelector(".header__nav");
const menu = document.querySelector(".header__hidden-burgernav");

burger.addEventListener("click", () => {
  if (burger.className.indexOf("active") === -1) {
    burger.classList.add("header__nav--active");
    menu.style.visibility = "visible";
    menu.style.clipPath = "circle(100%)";
  } else {
    burger.classList.remove("header__nav--active");
    menu.style.visibility = "hidden";
    menu.style.clipPath = "circle(13.9% at 0 0)";
  }
});
