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

const searchInput = document.querySelector(".header__search");
const logo = document.querySelector(".header__headline");
let screenWidth = screen.width;

window.addEventListener("resize", function () {
  screenWidth = screen.width;
});

searchInput.addEventListener("click", function (e) {
  const logo = document.querySelector(".header__headline");

  if (screenWidth < 724) {
    if (e.target === searchInput) {
      logo.style.display = "none";
      console.log("Test");
    }
  }
});

searchInput.addEventListener("focusout", function () {
  if (screenWidth < 724) {
    logo.style.display = "inline-block";
    console.log("focus off");
  }
});
