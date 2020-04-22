function removeItem(e) {
  const item = e.target.parentElement.querySelector(".products__name")
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);

  cart.products = cart.products.filter(function (item) {
    return item.name !== productInCart.name;
  });

  HappyLib.updateLocalStorage(cart.key, renderProducts);
}

function changeQuantity(e) {
  const val = e.target.parentElement.querySelector(".products__qty");
  const item = e.target.parentElement.querySelector(".products__name")
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);
  productInCart.quantity = val.value;
  if (val.value <= 0) {
    cart.products = cart.products.filter(function (item) {
      return item.name !== productInCart.name;
    });
  }
  HappyLib.updateLocalStorage(cart.key, renderProducts);
}

function updatePrice(str) {
  const totalPrice = document.querySelector(".products__total");
  const shipping = document.querySelector(".products__shipping-price");
  const headline = document.querySelector(".products__headline");
  const priceExclShipping = document.querySelector(".products__price-price");
  const price = HappyLib.getTotalPrice(cart.products);

  document.addOrder.price.value = price;
  if (str) str = str.toLowerCase();

  if (cart.products === undefined || cart.products.length === 0) {
    headline.textContent = "Your cart is empty";
    shipping.textContent = "0";
    totalPrice.textContent = "0";
  } else {
    headline.textContent = "Your Order";
    priceExclShipping.textContent = price + " SEK";
    if (price > 500 || str === "stockholm") {
      shipping.textContent = "FREE";
      totalPrice.textContent = price + " SEK";
    } else {
      shipping.textContent = "50 SEK";
      totalPrice.textContent = price + 50 + " SEK";
    }
  }
}

function renderProducts() {
  const items = document.querySelector(".products__container");

  items.innerHTML = "";
  renderCart();
  cart.products.forEach(function (item) {
    items.innerHTML += `<div class="products__item">
    <div class="products__img-wrap"><img class="products__img" src="./admin/images/${
      item.image
    }"/></div>
    
    <div class="products__text-wrap">
    <div class="products__name">${item.name}</div>
    <div class="products__item-total">${item.price * item.quantity} SEK</div>
    <input type="number" value="${item.quantity}" class="products__qty">
    </div>
    <span class="products__remove-btn">-</span>
    
    </div>`;
  });
  const removeBtn = document.querySelectorAll(".products__remove-btn");
  const qtyInput = document.querySelectorAll(".products__qty");

  HappyLib.addEvents(removeBtn, removeItem, "click");
  HappyLib.addEvents(qtyInput, changeQuantity, "change");
  HappyLib.addEvents(qtyInput, handleCartQty, "change");

  updatePrice();
}

HappyLib.localStorageInit(cart.key);
renderProducts();
const cityInput = addOrder.querySelector('input[name="city"]');
cityInput.addEventListener("keyup", function () {
  updatePrice(this.value);
});
