let header = document.querySelector(".header");

const words_to_filter = [
  "and",
  "not",
  "if",
  "get",
  "with",
  "keep",
  "that",
  "this",
  "every",
  "is",
  "let",
  "go",
];
function checkForm(form) {
  let search = form.searchWord.value;
  if (search.length <= 1 || words_to_filter.includes(search.trim())) {
    form.reset();
    form.searchWord.placeholder = "invalid Input";
    return false;
  }
  return true;
}

const searchInput = document.getElementsByClassName("header__search")[0];
const logo = document.querySelector(".header__headline");
let screenWidth = screen.width;

window.addEventListener("resize", function () {
  screenWidth = screen.width;
});

searchInput.addEventListener("focus", function () {
  const logo = document.querySelector(".header__headline");

  if (screenWidth < 724) {
    logo.style.display = "none";
  }
});

searchInput.addEventListener("focusout", function () {
  if (screenWidth < 724) {
    logo.style.display = "block";
  }
});
