const burger = document.querySelector('.header__nav');
const menu = document.querySelector('.header__hidden-burgernav');

burger.addEventListener('click', function () {
  if (burger.className.indexOf('active') === -1) {
    burger.classList.add('header__nav--active');
    menu.classList.add('burger-visible');
    menu.classList.remove('burger-hidden');
  } else {
    burger.classList.remove('header__nav--active');
    menu.classList.add('burger-hidden');
    menu.classList.remove('burger-visible');
  }
});
