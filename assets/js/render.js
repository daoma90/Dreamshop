document.addEventListener('click', function (e) {
  if (e.target.className.includes('__qty')) {
    HappyLib.updateLocalStorage(cart.key, renderProducts);

    updateProductArrayInputs();
    checkEmpty();
  }
});

document.addEventListener('click', function (e) {
  if (
    e.target.className.includes('__remove-btn') ||
    e.target.className.includes('cart-fixed__clear')
  ) {
    HappyLib.updateLocalStorage(cart.key, renderProducts);

    updateProductArrayInputs();
    checkEmpty();
  }
});

updateProductArrayInputs();

function checkEmpty() {
  if (cart.products.length === 0) {
    document.querySelector('.form-wrapper__checkout').outerHTML =
      '<div style="background: gray; cursor: auto" value="ORDER" class="form-wrapper__checkout" name="addOrder">ORDER</div>';
    document.querySelector('.products__completion-btns').innerHTML =
      '<div>Add some items to your cart first!</div><a class="err-btn" href="./">Go shopping</a>';
  }
}
function updateProductArrayInputs() {
  const productInputs = document.querySelector('.products-hidden');
  productInputs.innerHTML = '';
  cart.products.forEach(function (product) {
    const template =
      '<input type="hidden" name="products[]" value="' +
      product.id +
      '" /><input type="hidden" name="quantity[]" value="' +
      product.quantity +
      '" />';
    productInputs.innerHTML += template;
  });
}
