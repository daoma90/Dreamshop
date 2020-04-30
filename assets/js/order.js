function removeProduct(e) {
  const item = e.target.parentElement.querySelector('.products__name')
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);

  cart.products = cart.products.filter(function (item) {
    return item.name !== productInCart.name;
  });

  HappyLib.updateLocalStorage(cart.key, renderProducts);
}

function increaseOrderQty(e) {
  let input = e.target.parentElement.parentElement.querySelector(
    '.products__qty'
  );
  let qty = parseInt(input.value);
  qty++;
  input.value = qty;
  changeOrderQuantity(input);
}

function decreaseOrderQty(e) {
  let input = e.target.parentElement.parentElement.querySelector(
    '.products__qty'
  );
  let qty = parseInt(input.value);
  qty--;
  input.value = qty;

  changeOrderQuantity(input);
}

function changeOrderQuantity(e) {
  const val = e;
  const item = e.parentElement.parentElement.querySelector('.products__name')
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
    HappyLib.updateLocalStorage(cart.key, renderProducts);
    alert('Stock limit reached');
  }

  HappyLib.updateLocalStorage(cart.key, renderProducts);
}

function updatePrice(str) {
  const totalPrice = document.querySelector('.products__total');
  const shipping = document.querySelector('.products__shipping-price');
  const headline = document.querySelector('.products__headline');
  const priceExclShipping = document.querySelector('.products__price-price');
  const price = HappyLib.getTotalPrice(cart.products);

  if (str) str = str.toLowerCase();

  if (cart.products === undefined || cart.products.length === 0) {
    headline.textContent = 'Your cart is empty';
    shipping.textContent = '0';
    totalPrice.textContent = '0';
    priceExclShipping.textContent = '0';
  } else {
    headline.textContent = 'Your Order';
    priceExclShipping.textContent = price + ' SEK';
    if (price > 500 || str === 'stockholm') {
      shipping.textContent = 'FREE';
      totalPrice.textContent = price + ' SEK';
    } else {
      shipping.textContent = '50 SEK';
      totalPrice.textContent = price + 50 + ' SEK';
    }
  }
}

function renderProducts() {
  const items = document.querySelector('.products__container');

  items.innerHTML = '';
  renderCart();
  cart.products.forEach(function (item) {
    // items.innerHTML += `<div class="products__item">
    // <div class="products__img-wrap"><img class="products__img" src="./admin/images/${
    //   item.image
    // }"/></div>

    // <div class="products__text-wrap">
    // <div class="products__name">${item.name}</div>
    // <div class="products__item-total">${item.price * item.quantity} SEK</div>
    // <div class="products__qty-wrap">
    //   <button class="products__qty-down"><i class="fa fa-minus"></i></button>
    //   <input
    //     class="products__qty"
    //     type="text"
    //     value="${item.quantity}"
    //     readonly
    //   />
    //   <button class="products__qty-up"><i class="fa fa-plus"></i></button>
    // </div>
    // </div>
    // <span class="products__remove-btn">-</span>
    // </div>`;
    items.innerHTML += '<div class="products__item">\n    <div class="products__img-wrap"><img class="products__img" src="./admin/images/'
      .concat(
        item.image,
        '"/></div>\n\n    <div class="products__text-wrap">\n    <div class="products__name">'
      )
      .concat(item.name, '</div>\n    <div class="products__item-total">')
      .concat(
        item.price * item.quantity,
        ' SEK</div>\n    <div class="products__qty-wrap">\n      <button class="products__qty-down"><i class="fa fa-minus __qty"></i></button>\n      <input\n        class="products__qty"\n        type="text"\n        value="'
      )
      .concat(
        item.quantity,
        '"\n        readonly\n      />\n      <button class="products__qty-up"><i class="fa fa-plus __qty"></i></button>\n    </div>\n    </div>\n    <span class="products__remove-btn">-</span>\n    </div>'
      );
  });
  const removeBtn = document.querySelectorAll('.products__remove-btn');
  const qtyInput = document.querySelectorAll('.products__qty');
  const orderQtyUp = document.querySelectorAll('.products__qty-up');
  const orderQtyDown = document.querySelectorAll('.products__qty-down');

  HappyLib.addEvents(removeBtn, removeProduct, 'click');
  HappyLib.addEvents(orderQtyUp, increaseOrderQty, 'click');
  HappyLib.addEvents(orderQtyDown, decreaseOrderQty, 'click');
  // HappyLib.addEvents(qtyInput, changeOrderQuantity, "change");

  updatePrice();
}

HappyLib.localStorageInit(cart.key);
renderProducts();

document.addEventListener('DOMContentLoaded', function () {
  if (cart.products.length == 0) {
    document.querySelector('.form-wrapper__checkout').outerHTML =
      '<div style="background: gray; cursor: auto" value="ORDER" class="form-wrapper__checkout" name="addOrder">ORDER</div>';
    document.querySelector('.products__completion-btns').innerHTML =
      '<div>Add some items to your cart first!</div><a class="err-btn" href="./">Go shopping</a>';
  }

  // Quickfix, remove shipping fee based on city
  const cityInput = addOrder.querySelectorAll('.form-wrapper__input')[5];
  cityInput.addEventListener('change', function () {
    updatePrice(this.value);
  });
});
