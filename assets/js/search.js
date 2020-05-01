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
const logoWrap = document.querySelector(".header__headline");
let screenWidth = screen.width;

window.addEventListener("resize", function () {
  screenWidth = screen.width;
});

searchInput.addEventListener("click", function (e) {
  const logoWrap = document.querySelector(".header__headline");

  if (screenWidth < 724) {
    if (e.target === searchInput) {
      logoWrap.style.visibility = "hidden";
      logoWrap.style.width = "0px";
    }
  }
});

searchInput.addEventListener("focusout", function () {
  if (screenWidth < 724) {
    setTimeout(function () {
      logoWrap.style.width = "110px";
    }, 250);
    setTimeout(function () {
      logoWrap.style.visibility = "visible";
    }, 500);
  }
});
