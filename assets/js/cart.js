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
        id: product[0].id,
        name: product[0].name,
        price: product[0].price,
        image: product[0].image,
        quantity: inputQty ? parseInt(inputQty.value) : 1,
        stock: parseInt(product[0].stock),
        sale_price: product[0].sale_price,
        has_discount: product[0].has_discount,
      };

      const productInCart = HappyLib.findProduct(tempObj.name, cart);

      if (!productInCart) {
        if (inputQty && tempObj.stock < parseInt(inputQty.value)) {
          tempObj.quantity = tempObj.stock;
          cart.products.push(tempObj);
          customAlert(
            'Stock limit reached! Total cart quantity is ' + tempObj.stock,
            'alert'
          );
          //alert('Stock limit reached! Total cart quantity is ' + tempObj.stock);
        } else {
          cart.products.push(tempObj);
        }
      } else {
        if (inputQty) {
          productInCart.quantity += parseInt(inputQty.value);
        } else {
          productInCart.quantity++;
        }
        // If quantity is raised above the current stock quantity the value will be set to the max stock quantity
        if (tempObj.stock <= productInCart.quantity) {
          productInCart.quantity = tempObj.stock;
          //alert('No more of these in stock!');
          customAlert('No more of these in stock!', 'alert');
        }
      }
      HappyLib.updateLocalStorage(cart.key, renderCart);
    }
  };
  request.open('POST', './assets/php/addToCart.php?id=' + id, true);
  request.send();
}

function increaseCartQty(e) {
  let input = e.target.parentElement.parentElement.querySelector(
    '.cart-fixed__qty'
  );
  let qty = parseInt(input.value);
  qty++;
  input.value = qty;
  changeQuantity(input);
}

function decreaseCartQty(e) {
  let input = e.target.parentElement.parentElement.querySelector(
    '.cart-fixed__qty'
  );
  let qty = parseInt(input.value);
  qty--;
  input.value = qty;

  changeQuantity(input);
}

function increaseQty(e) {
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
  const val = e;
  const item = e.parentElement.parentElement.querySelector('.cart-fixed__name')
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);
  productInCart.quantity = val.value;
  if (val.value <= 0) {
    cart.products = cart.products.filter(function (item) {
      return item.name !== productInCart.name;
    });
  }
  if (
    productInCart !== undefined &&
    parseInt(val.value) > productInCart.stock
  ) {
    productInCart.quantity = productInCart.stock;
    HappyLib.updateLocalStorage(cart.key, renderCart);
    //alert('Stock limit reached');
    customAlert('Stock limit reached!', 'alert');
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
  // cart.products.forEach(function (item) {
  //   items.innerHTML += '<li class="cart-fixed__item">\n                            <div class="cart-fixed__img-wrap"><img class="cart-fixed__img" src="./admin/images/'
  //     .concat(
  //       item.image,
  //       '"/></div>\n\n                            <div class="cart-fixed__text-wrap">\n                                <div class="cart-fixed__name">'
  //     )
  //     .concat(
  //       item.name,
  //       '</div>\n                                <div class="cart-fixed__item-total">'
  //     )
  //     .concat(
  //       item.price * item.quantity,
  //       ' €</div>\n                                <div class="cart-fixed__qty-wrap">\n                                  <button class="cart-fixed__qty-down"><i class="fa fa-minus __qty"></i></button>\n                                  <input\n                                    class="cart-fixed__qty"\n                                    type="text"\n                                    value="'
  //     )
  //     .concat(
  //       item.quantity,
  //       '"\n                                    readonly\n                                  />\n                                  <button class="cart-fixed__qty-up"><i class="fa fa-plus __qty"></i></button>\n                                </div>\n                            </div>\n                            <span class="cart-fixed__remove-btn">-</span>\n                          </li>'
  //     );
  // });

  cart.products.forEach(function (item) {
    let price = `<div class="cart-fixed__item-total">${item.price} €</div>`;
    if (item.has_discount !== '0') {
      price = `
      <div class="cart-fixed__item-total cart-fixed__item-total--old">${item.price} €</div>
      <div class="cart-fixed__item-total">${item.sale_price} €</div>`;
    }

    items.innerHTML += `<li class="cart-fixed__item">
                          <div class="cart-fixed__img-wrap"><img class="cart-fixed__img" src="./admin/images/${item.image}"/></div>

                          <div class="cart-fixed__text-wrap">
                              <div class="cart-fixed__name">${item.name}</div>
                              ${price}
  <div class="cart-fixed__qty-wrap">
    <button class="cart-fixed__qty-down"><i class="fa fa-minus __qty"></i></button>
    <input
      class="cart-fixed__qty"
      type="text"
      value="${item.quantity}"
      readonly
    />
    <button class="cart-fixed__qty-up"><i class="fa fa-plus __qty"></i></button>
  </div>
                          </div>
                          <span class="cart-fixed__remove-btn">-</span>
                        </li>`;
  });

  const removeBtn = document.querySelectorAll('.cart-fixed__remove-btn');
  const cartQtyUp = document.querySelectorAll('.cart-fixed__qty-up');
  const cartQtyDown = document.querySelectorAll('.cart-fixed__qty-down');
  const discounted_price = HappyLib.getDiscount(cart.products);

  HappyLib.addEvents(removeBtn, removeItem, 'click');
  HappyLib.addEvents(cartQtyUp, increaseCartQty, 'click');
  HappyLib.addEvents(cartQtyDown, decreaseCartQty, 'click');

  totalPrice.textContent = price - discounted_price + ' €';
  totalQty.textContent = qty + ' Items';
  totalQtyIconNotif.textContent = qty;
}

function clearCart() {
  const items = document.querySelector('.cart-fixed__cart-items');
  const totalPrice = document.querySelector('.cart-fixed__total');
  const totalProductQty = document.querySelector('.cart-fixed__total-qty');
  const totalQtyIconNotif = document.querySelector('.icon-notif');

  if (document.querySelector('.products')) {
    HappyLib.updateLocalStorage(cart.key, renderProducts);
  }

  items.innerHTML = '';
  totalProductQty.textContent = '0 Items';
  totalQtyIconNotif.textContent = '0';
  totalPrice.textContent = '0 €';
  cart.products = [];
  localStorage.clear();
}

HappyLib.localStorageInit(cart.key);

document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.cart-fixed__clear')) {
    const clearBtn = document.querySelector('.cart-fixed__clear');
    const cartToggle_header = document.querySelector('.header__cart-toggle');
    const cart = document.querySelector('.cart-fixed');
    const cartOverlay = document.querySelector('.bg-overlay');
    // must change in _cart.scss aswell
    const animDuration = 200;

    if (document.querySelector('.productpage__qty')) {
      const qtyUp = document.querySelector('.productpage__qty-up');
      const qtyDown = document.querySelector('.productpage__qty-down');
      inputQty = document.querySelector('.productpage__qty');

      qtyUp.addEventListener('click', increaseQty);
      qtyDown.addEventListener('click', decreaseQty);
    }

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
