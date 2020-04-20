function renderProducts() {
  const items = document.querySelector(".products__container");
  const totalPrice = document.querySelector(".products__total");
  const totalQty = document.querySelector(".products__total-qty");
  const totalQtyIconNotif = document.querySelector(".icon-notif");
  const price = HappyLib.getTotalPrice(cart.products);
  const qty = HappyLib.getTotalQty(cart.products);

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
}

HappyLib.localStorageInit(cart.key);
renderProducts();
console.log(cart.products);
