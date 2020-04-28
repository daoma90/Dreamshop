document.addEventListener('change', function (e) {
  if (e.target.className.includes('cart-fixed__qty')) {
    HappyLib.updateLocalStorage(cart.key, renderProducts);
  }
});

document.addEventListener('click', function (e) {
  if (
    e.target.className.includes('cart-fixed__remove-btn') ||
    e.target.className.includes('cart-fixed__clear')
  ) {
    HappyLib.updateLocalStorage(cart.key, renderProducts);
  }
});