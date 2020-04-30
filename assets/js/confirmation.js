const total = document.getElementById("total").dataset.total;
const productsContainer = document.querySelector(".confirmation-products");

const id = document.getElementById("id").dataset.id;
const productsTop = document.querySelector(".products-top");

productsTop.innerHTML += "<p class='products-id'>Order ID: " + id + "</p>";

for (var i = 0; i < localStorage.length; i++) {
  let key = localStorage.getItem(localStorage.key(i));
  let value = JSON.parse(key);

  for (let i = 0; i < value.length; i++) {
    const elm = value[i];
    let wrapper = document.querySelector(".confirmation-products");
    wrapper.innerHTML += '\n    <div class="product">\n      <div class="product__image"> <img src="../FE-Project-Shop/admin/images/'
      .concat(
        elm.image,
        '"></div>\n      <div class="product__info">\n        <div class="product__name">'
      )
      .concat(elm.name, '</div>\n        <div class="product__price">')
      .concat(
        elm.price,
        ' EUR</div>\n        <div class="product__quantity">Quantity: '
      )
      .concat(elm.quantity, "</div>\n      </div>\n    </div>");
  }
}
// productsContainer.innerHTML +=
//   '<div class="confirmation-products__total"><p class="confirmation-products__total-text">TOTAL</p>' +
//   '<p class="confirmation-products__total-number">' +
//   total +
//   ' €' +
//   '</p></div>';
productsContainer.innerHTML +=
  '<div class="confirmation-products__total"><p class="confirmation-products__total-text">TOTAL</p>' +
  '<p class="confirmation-products__total-number">' +
  total +
  " €" +
  "</p></div>";
localStorage.clear();
