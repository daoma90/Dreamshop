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

const order = document.querySelector('#order');
const orderSubMenu = document.querySelector('#sub-order');

order.addEventListener('click', function () {
  if (orderSubMenu.classList.contains('header__sub-list--hidden')) {
    orderSubMenu.classList.remove('header__sub-list--hidden');
    orderSubMenu.classList.add('header__sub-list--show');
  } else {
    orderSubMenu.classList.remove('header__sub-list--show');
    orderSubMenu.classList.add('header__sub-list--hidden');
  }
});

const products = document.querySelector('#products');
const productsSubMenu = document.querySelector('#sub-products');

products.addEventListener('click', function () {
  if (productsSubMenu.classList.contains('header__sub-list--hidden')) {
    productsSubMenu.classList.remove('header__sub-list--hidden');
    productsSubMenu.classList.add('header__sub-list--show');
  } else {
    productsSubMenu.classList.remove('header__sub-list--show');
    productsSubMenu.classList.add('header__sub-list--hidden');
  }
});
