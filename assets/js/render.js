document.addEventListener('change', function (e) {
  if (e.target.className.includes('__qty')) {
    HappyLib.updateLocalStorage(cart.key, renderProducts);
    checkEmpty();
  }
});

document.addEventListener('click', function (e) {
  if (
    e.target.className.includes('__remove-btn') ||
    e.target.className.includes('cart-fixed__clear')
  ) {
    HappyLib.updateLocalStorage(cart.key, renderProducts);
    checkEmpty();
  }
<<<<<<< HEAD
});
=======
});

function checkEmpty() {
  if (cart.products.length === 0) {
    document.querySelector('.form-wrapper__checkout').outerHTML =
      '<div style="background: gray; cursor: auto" value="ORDER" class="form-wrapper__checkout" name="addOrder">ORDER</div>';
    document.querySelector('.products__completion-btns').innerHTML =
      '<div>Add some items to your cart first!</div><a class="err-btn" href="./">Go shopping</a>';
  }
}
>>>>>>> 1f9695848f6af1ffc648ef655126101c5de7f171
