let header = document.querySelector('.header');

const words_to_filter = [
  'and',
  'not',
  'if',
  'get',
  'with',
  'keep',
  'that',
  'this',
  'every',
  'is',
  'let',
  'go',
];
function checkForm(form) {
  let search = form.searchWord.value.trim();
  if (search.length <= 1 || words_to_filter.includes(search)) {
    form.reset();
    form.searchWord.placeholder = 'Must have atleast 2 characters';
    return false;
  }
  return true;
}

const searchInput = document.querySelector('.header__search');
const logoWrap = document.querySelector('.header__headline');
const searchWrap = document.querySelector('.header__form');
let screenWidth = document.querySelector('body').clientWidth;

window.addEventListener('resize', function () {
  screenWidth = document.querySelector('body').clientWidth;
  if (screenWidth > 724) {
    searchWrap.style.width = '50%';
    searchInput.placeholder = 'Search';
  } else if (screenWidth < 724) {
    searchWrap.style.width = '45px';
    searchInput.placeholder = '';
  }
});

searchInput.addEventListener('click', function (e) {
  const logoWrap = document.querySelector('.header__headline');

  if (screenWidth < 724) {
    if (e.target === searchInput) {
      logoWrap.style.visibility = 'hidden';
      logoWrap.style.width = '0px';
      searchWrap.style.width = '60%';
      searchInput.placeholder = 'Search';
    }
  }
});

searchInput.addEventListener('focusout', function () {
  if (screenWidth < 724) {
    logoWrap.style.width = '110px';
    searchWrap.style.width = '45px';
    searchInput.placeholder = '';
    setTimeout(function () {
      logoWrap.style.visibility = 'visible';
    }, 250);
  }
});
