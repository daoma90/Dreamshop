const total = document.getElementById('total').dataset.total;
const productsContainer = document.querySelector('.confirmation-products');

const id = document.getElementById('id').dataset.id;
const productsTop = document.querySelector('.products-top');

for (var i = 0; i < localStorage.length; i++) {
  let key = localStorage.getItem(localStorage.key(i));
  let value = JSON.parse(key);

  for (let i = 0; i < value.length; i++) {
    const elm = value[i];
    let wrapper = document.querySelector('.confirmation-products');
    wrapper.innerHTML += `
    <div class="product">
      <div class="product__image"> <img src="../FE-Project-Shop/admin/images/${elm.image}"></div>
      <div class="product__info">
        <div class="product__name">${elm.name}</div>
        <div class="product__price">${elm.price}</div>
        <div class="product__quantity">Quantity: ${elm.quantity}</div>
      </div>
    </div>`;
    /* wrapper.innerHTML += ' \n    <div>'
      .concat(elm.name, '</div>\n    <div>')
      .concat(elm.price, '</div>\n    <div>')
      .concat(
        elm.quantity,
        '</div>\n    <div> <img src="../FE-Project-Shop/admin/images/'
      )
      .concat(elm.image, '"></div>'); */
  }
}
productsTop.innerHTML += "<p class='products-id'>Order ID: " + id + '</p>';
productsContainer.innerHTML +=
  '<div class="confirmation-products__total"><p class="confirmation-products__total-text">TOTAL</p>' +
  '<p class="confirmation-products__total-number">' +
  total +
  ' €' +
  '</p></div>';
localStorage.clear();

/* let wrapper = document.querySelector(".confirmation-products");
wrapper.innerHTML += `
    <div class="product">
      <div class="product__img"> <img src="admin/images/boots.jpg"></div>
      <div class="product__info">
        <div class="product__name">Name</div>
        <div class="product__price">100 EUR</div>
        <div class="product__quantity">Quantity: 3</div>
      </div>
    </div>

    <div class="product">
      <div class="product__img"> <img src="admin/images/boots.jpg"></div>
      <div class="product__info">
        <div class="product__name">Name</div>
        <div class="product__price">100 EUR</div>
        <div class="product__quantity">Quantity: 3</div>
      </div>
    </div>`;
 */
