if (!String.prototype.includes) {
  String.prototype.includes = function (search, start) {
    'use strict';

    if (search instanceof RegExp) {
      throw TypeError('first argument must not be a RegExp');
    }
    if (start === undefined) {
      start = 0;
    }
    return this.indexOf(search, start) !== -1;
  };
}

document.addEventListener('click', function (e) {
  if (
    e.target.className.includes('feature-products__add') ||
    e.target.className.includes('productpage__add')
  ) {
    const product_id = e.target.dataset.id;
    addToCart(product_id);
  }
});
let inputQty;
const cart = {
  // Key should be randomized in a real project. Used as reference point and unique identifier
  key: 'qwerqwerqwerqwerqwerqwer',
  products: [],
};

function addToCart(id) {
  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const product = JSON.parse(this.response);
      let tempObj = {
        name: product[0].name,
        price: product[0].price,
        image: product[0].image,
        quantity: inputQty ? parseInt(inputQty.value) : 1,
        stock: product[0].stock,
      };

      const productInCart = HappyLib.findProduct(tempObj.name, cart);

      if (!productInCart) {
        cart.products.push(tempObj);
      } else {
        if (inputQty) {
          productInCart.quantity += parseInt(inputQty.value);
        } else {
          productInCart.quantity++;
        }
        // If quantity is raised above the current stock quantity the value will be set to the max stock quantity
        if (tempObj.stock < productInCart.quantity) {
          productInCart.quantity = tempObj.stock;
          alert('No more of these in stock!');
        }
      }
      HappyLib.updateLocalStorage(cart.key, renderCart);
    }
  };
  request.open('POST', './assets/php/addToCart.php?id=' + id, true);
  request.send();
}

function increaseQty() {
  let realValue = parseInt(inputQty.value);
  realValue += 1;
  inputQty.value = realValue;
}

function decreaseQty() {
  let realValue = parseInt(inputQty.value);

  if (realValue > 1) {
    realValue -= 1;
    inputQty.value = realValue;
  }
}

function handleQty() {
  if (inputQty.value <= 0) {
    inputQty.value = 1;
  }
}

function handleCartQty(e) {
  const clickedProduct = e.target.parentElement.querySelector(
    '.cart-fixed__name'
  ).textContent;
  const inputQty = e.target.parentElement.querySelector('.cart-fixed__qty');
  const productInCart = HappyLib.findProduct(clickedProduct, cart);
  if (productInCart !== undefined && inputQty.value > productInCart.stock) {
    productInCart.quantity = productInCart.stock;
    HappyLib.updateLocalStorage(cart.key, renderCart);
    alert('Stock limit reached');
  }
}

function removeItem(e) {
  const item = e.target.parentElement.querySelector('.cart-fixed__name')
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);

  cart.products = cart.products.filter(function (item) {
    return item.name !== productInCart.name;
  });

  HappyLib.updateLocalStorage(cart.key, renderCart);
}

function changeQuantity(e) {
  const val = e.target.parentElement.querySelector('.cart-fixed__qty');
  const item = e.target.parentElement.querySelector('.cart-fixed__name')
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);
  productInCart.quantity = val.value;
  if (val.value <= 0) {
    cart.products = cart.products.filter(function (item) {
      return item.name !== productInCart.name;
    });
  }
  HappyLib.updateLocalStorage(cart.key, renderCart);
}

function renderCart() {
  const items = document.querySelector('.cart-fixed__cart-items');
  const totalPrice = document.querySelector('.cart-fixed__total');
  const totalQty = document.querySelector('.cart-fixed__total-qty');
  const totalQtyIconNotif = document.querySelector('.icon-notif');
  const price = HappyLib.getTotalPrice(cart.products);
  const qty = HappyLib.getTotalQty(cart.products);

  items.innerHTML = '';
  //RUN COMMENTED CODE BELOW IN BABEL COMPILER AND REPLACE WITH THIS CODE
  cart.products.forEach(function (item) {
    items.innerHTML += '<li class="cart-fixed__item">\n                            <div class="cart-fixed__img-wrap"><img class="cart-fixed__img" src="./admin/images/'
      .concat(
        item.image,
        '"/></div>\n\n                            <div class="cart-fixed__text-wrap">\n                                <div class="cart-fixed__name">'
      )
      .concat(
        item.name,
        '</div>\n                                <div class="cart-fixed__item-total">'
      )
      .concat(
        item.price * item.quantity,
        ' SEK</div>\n                                <input type="number" value="'
      )
      .concat(
        item.quantity,
        '" class="cart-fixed__qty">\n                            </div>\n                            <span class="cart-fixed__remove-btn">-</span>\n\n                          </li>'
      );
  });
  // cart.products.forEach(function (item) {
  //   items.innerHTML += `<li class="cart-fixed__item">
  //                           <div class="cart-fixed__img-wrap"><img class="cart-fixed__img" src="./admin/images/${
  //                             item.image
  //                           }"/></div>

  //                           <div class="cart-fixed__text-wrap">
  //                               <div class="cart-fixed__name">${item.name}</div>
  //                               <div class="cart-fixed__item-total">${
  //                                 item.price * item.quantity
  //                               } SEK</div>
  //                               <input type="number" value="${
  //                                 item.quantity
  //                               }" class="cart-fixed__qty">
  //                           </div>
  //                           <span class="cart-fixed__remove-btn">-</span>

  //                         </li>`;
  // });

  const removeBtn = document.querySelectorAll('.cart-fixed__remove-btn');
  const qtyInput = document.querySelectorAll('.cart-fixed__qty');

  HappyLib.addEvents(removeBtn, removeItem, 'click');
  HappyLib.addEvents(qtyInput, changeQuantity, 'change');
  HappyLib.addEvents(qtyInput, handleCartQty, 'change');

  totalPrice.textContent = price + ' SEK';
  totalQty.textContent = qty + ' Items';
  totalQtyIconNotif.textContent = qty;
}

function clearCart() {
  const items = document.querySelector('.cart-fixed__cart-items');
  const totalPrice = document.querySelector('.cart-fixed__total');
  const totalProductQty = document.querySelector('.cart-fixed__total-qty');
  const totalQtyIconNotif = document.querySelector('.icon-notif');

  items.innerHTML = '';
  totalProductQty.textContent = '0 Items';
  totalQtyIconNotif.textContent = '0';
  totalPrice.textContent = '0 SEK';
  cart.products = [];
  localStorage.clear();
}

function renderCheckout(e) {
  e.preventDefault();
  const target = e.target.href;
  // const loadPopup = `<div class="load-popup">
  //                         <h2 class="load-popup__headline">Your order is being processed!</h2>
  //                         <img class="load-popup__animation" src="./images/loading.svg">
  //                       </div>`;
  const loadPopup =
    '<div class="load-popup">\n<h2 class="load-popup__headline">Your order is being processed!</h2>\n<img class="load-popup__animation" src="./images/loading.svg">\n</div>';

  document.body.innerHTML = loadPopup;
  const body = document.querySelector('body');
  body.classList.add('no-after');
  setTimeout(function () {
    window.location = target;
  }, 2500);
}

HappyLib.localStorageInit(cart.key);

document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.cart-fixed__clear')) {
    const purchaseBtn = document.querySelector('.cart-fixed__checkout');
    const clearBtn = document.querySelector('.cart-fixed__clear');
    const cartToggle_header = document.querySelector('.header__cart-toggle');
    const cart = document.querySelector('.cart-fixed');
    const cartOverlay = document.querySelector('.bg-overlay');
    // must change in _cart.scss aswell
    const animDuration = 200;

    if (document.querySelector('.productpage')) {
      const qtyUp = document.querySelector('.productpage__qty-up');
      const qtyDown = document.querySelector('.productpage__qty-down');
      inputQty = document.querySelector('.productpage__qty');

      qtyUp.addEventListener('click', increaseQty);
      qtyDown.addEventListener('click', decreaseQty);
    }

    purchaseBtn.addEventListener('click', renderCheckout);
    clearBtn.addEventListener('click', clearCart);

    cartToggle_header.addEventListener('click', function () {
      if (
        cart.className.includes('hide-animation') ||
        cart.className.includes('hidden')
      ) {
        cart.classList.remove('hidden');
        cart.classList.add('show-animation');
        cartOverlay.classList.remove('hidden');
        setTimeout(function () {
          cart.classList.remove('show-animation');
        }, animDuration);
      } else {
        cart.classList.add('hide-animation');
        cartOverlay.classList.add('hide-overlay');
        setTimeout(function () {
          cartOverlay.classList.remove('hide-overlay');
          cart.classList.remove('hide-animation');
          cart.classList.add('hidden');
          cartOverlay.classList.add('hidden');
        }, animDuration);
      }
    });
    cartOverlay.addEventListener('click', function () {
      cart.classList.add('hide-animation');
      cartOverlay.classList.add('hide-overlay');
      setTimeout(function () {
        cartOverlay.classList.remove('hide-overlay');
        cart.classList.remove('hide-animation');
        cart.classList.add('hidden');
        cartOverlay.classList.add('hidden');
      }, animDuration);
    });
    renderCart();
  }
});
