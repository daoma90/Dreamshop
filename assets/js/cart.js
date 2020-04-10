document.addEventListener('click', function (e) {
  if (e.target.className.includes('feature-products__add')) {
    const product_id = e.target.parentElement.dataset.id;
    addToCart(product_id);
  }
});

const cart = {
  // Key should be randomized in a real project. Used as reference point and unique identifier
  key: 'qwerqwerqwerqwerqwerqwer',
  products: [],
};

async function addToCart(id) {
  const response = await fetch(`./assets/php/addToCart.php?id=${id}`);
  const product = await response.json();

  let tempObj = {
    name: product[0].name,
    price: product[0].price,
    image: product[0].image,
    quantity: 1,
    stock: 5,
  };

  const productInCart = HappyLib.findProduct(tempObj.name, cart);

  if (!productInCart) {
    cart.products.push(tempObj);
  } else {
    productInCart.quantity += 1;
    // If quantity is raised above the current stock quantity the value will be set to the max stock quantity
    if (tempObj.stock < productInCart.quantity) {
      productInCart.quantity = tempObj.stock;
      alert('No more of these in stock!');
    }
  }
  HappyLib.updateLocalStorage(cart.key, renderCart);
}

const increaseQty = (e) => {
  const inputQty = e.target.parentElement.querySelector('.product-card__qty');
  let realValue = parseInt(inputQty.value);
  realValue += 1;
  inputQty.value = realValue;
};

const decreaseQty = (e) => {
  const inputQty = e.target.parentElement.querySelector('.product-card__qty');
  let realValue = parseInt(inputQty.value);

  if (realValue > 1) {
    realValue -= 1;
    inputQty.value = realValue;
  }
};

const handleQty = (e) => {
  const inputQty = e.target.parentElement.querySelector('.product-card__qty');

  if (inputQty.value <= 0) {
    inputQty.value = 1;
  }
};

const handleCartQty = (e) => {
  const clickedProduct = e.target.parentElement.querySelector(
    '.cart-fixed__name'
  ).textContent;
  const inputQty = e.target.parentElement.querySelector('.cart-fixed__qty');
  const productInCart = HappyLib.findProduct(clickedProduct, cart);
  if (inputQty.value > productInCart.stock) {
    productInCart.quantity = productInCart.stock;
    HappyLib.updateLocalStorage(cart.key, renderCart);
    alert('Stock limit reached');
  }
};

const removeItem = (e) => {
  const item = e.target.parentElement.querySelector('.cart-fixed__name')
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);

  cart.products = cart.products.filter((item) => {
    return item.name !== productInCart.name;
  });

  HappyLib.updateLocalStorage(cart.key, renderCart);
};

const changeQuantity = (e) => {
  const val = e.target.parentElement.querySelector('.cart-fixed__qty');
  const item = e.target.parentElement.querySelector('.cart-fixed__name')
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);
  productInCart.quantity = val.value;
  if (val.value <= 0) {
    cart.products = cart.products.filter((item) => {
      return item.name !== productInCart.name;
    });
  }
  HappyLib.updateLocalStorage(cart.key, renderCart);
};

const renderCart = () => {
  const items = document.querySelector('.cart-fixed__cart-items');
  const totalPrice = document.querySelector('.cart-fixed__total');
  const totalQty = document.querySelector('.cart-fixed__total-qty');
  const price = HappyLib.getTotalPrice(cart.products);
  const qty = HappyLib.getTotalQty(cart.products);

  items.innerHTML = '';
  cart.products.forEach((item) => {
    items.innerHTML += `<li class="cart-fixed__item">
                            <div class="cart-fixed__img-wrap"><img class="cart-fixed__img" src="${
                              item.image
                            }"/></div>

                            <div class="cart-fixed__text-wrap">
                                <div class="cart-fixed__name">${item.name}</div>
                                <div class="cart-fixed__item-total">${
                                  item.price * item.quantity
                                } kr</div>
                                <input type="number" value="${
                                  item.quantity
                                }" class="cart-fixed__qty">
                            </div>
                            <span class="cart-fixed__remove-btn">-</span>


                          </li>`;
  });

  const removeBtn = document.querySelectorAll('.cart-fixed__remove-btn');
  const qtyInput = document.querySelectorAll('.cart-fixed__qty');

  HappyLib.addEvents(removeBtn, removeItem, 'click');
  HappyLib.addEvents(qtyInput, changeQuantity, 'change');
  HappyLib.addEvents(qtyInput, handleCartQty, 'change');

  totalPrice.textContent = `${price} kr`;
  totalQty.textContent = `${qty} Items`;
};

const clearCart = () => {
  const items = document.querySelector('.cart-fixed__cart-items');
  const totalPrice = document.querySelector('.cart-fixed__total');
  const totalProductQty = document.querySelector('.cart-fixed__total-qty');
  items.innerHTML = '';
  totalProductQty.textContent = '0';
  totalPrice.textContent = '0 kr';
  cart.products = [];
  localStorage.clear();
};

const renderCheckout = (e) => {
  e.preventDefault();
  const target = e.target.href;
  const loadPopup = `<div class="load-popup">
                          <h2 class="load-popup__headline">Your order is being processed!</h2>
                          <img class="load-popup__animation" src="./images/loading.svg">
                        </div>`;

  document.body.innerHTML = loadPopup;
  const body = document.querySelector('body');
  body.classList.add('no-after');
  setTimeout(function () {
    window.location = target;
  }, 2500);
};

HappyLib.localStorageInit(cart.key);

document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.cart-fixed__clear')) {
    const purchaseBtn = document.querySelector('.cart-fixed__checkout');
    const clearBtn = document.querySelector('.cart-fixed__clear');
    const cartToggle_header = document.querySelector('.header__cart-toggle');
    const cart = document.querySelector('.cart-fixed');
    // must change in _cart.scss aswell
    const animDuration = 200;

    purchaseBtn.addEventListener('click', renderCheckout);
    clearBtn.addEventListener('click', clearCart);

    cartToggle_header.addEventListener('click', function () {
      if (
        cart.className.includes('hide-animation') ||
        cart.className.includes('hidden')
      ) {
        cart.classList.remove('hidden');
        cart.classList.add('show-animation');
        setTimeout(() => {
          cart.classList.remove('show-animation');
        }, animDuration);
      } else {
        cart.classList.add('hide-animation');
        setTimeout(() => {
          cart.classList.remove('hide-animation');
          cart.classList.add('hidden');
        }, animDuration);
      }
    });
    renderCart();
  }
});
