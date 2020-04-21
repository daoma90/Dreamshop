function removeItem(e) {
  const item = e.target.parentElement.querySelector(".products__name")
    .textContent;

  const productInCart = HappyLib.findProduct(item, cart);

  cart.products = cart.products.filter(function (item) {
    return item.name !== productInCart.name;
  });

  HappyLib.updateLocalStorage(cart.key, renderProducts);
}

function renderProducts() {
  const items = document.querySelector(".products__container");
  const totalPrice = document.querySelector(".products__total");
  const price = HappyLib.getTotalPrice(cart.products);

  items.innerHTML = "";
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

  totalPrice.textContent = price + " SEK";
}

HappyLib.localStorageInit(cart.key);
renderProducts();
