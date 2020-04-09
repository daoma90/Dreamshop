document.addEventListener('click', function (e) {
  if (e.target.className.includes('lp-categories__')) {
    const category = e.target.parentElement.querySelector(
      '.lp-categories__title'
    ).textContent;

    getProducts(category);
  }
});

function getProducts(category) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(
        '.lp-products__wrap'
      ).innerHTML = this.responseText;

      document.querySelector(
        '.lp-products__current-category'
      ).textContent = category;
    }
  };
  xmlhttp.open('POST', `./assets/php/products.php?category=${category}`, true);
  xmlhttp.send();
}
