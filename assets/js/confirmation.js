const cart = {
  // Key should be randomized in a real project. Used as reference point and unique identifier
  key: "qwerqwerqwerqwerqwerqwer",
  products: [],
};

HappyLib.localStorageInit(cart.key);

const total = HappyLib.getTotalPrice(cart.products);
const productsContainer = document.querySelector(".confirmation-products");
const id = document.getElementById("id").dataset.id;
const productsTop = document.querySelector(".products-top");
let wrapper = document.querySelector(".confirmation-products");

productsTop.innerHTML += "<p class='products-id'>Order ID: " + id + "</p>";

cart.products.forEach((item) => {
  wrapper.innerHTML += '\n    <div class="product">\n      <div class="product__image"> <img src="../FE-Project-Shop/admin/images/'
    .concat(
      item.image,
      '"></div>\n      <div class="product__info">\n        <div class="product__name">'
    )
    .concat(item.name, '</div>\n        <div class="product__price">')
    .concat(
      item.price,
      ' EUR</div>\n        <div class="product__quantity">Quantity: '
    )
    .concat(item.quantity, "</div>\n      </div>\n    </div>");
});

productsContainer.innerHTML +=
  '<div class="confirmation-products__total"><p class="confirmation-products__total-text">TOTAL</p>' +
  '<p class="confirmation-products__total-number">' +
  total +
  " €" +
  "</p></div>";

cart.products = [];
localStorage.clear();
