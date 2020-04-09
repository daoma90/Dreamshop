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
      const categoryTitle = document.querySelector(
        '.lp-products__current-category'
      );

      document.querySelector(
        '.lp-products__wrap'
      ).innerHTML = this.responseText;

      categoryTitle.textContent = category;
      categoryTitle.scrollIntoView();
    }
  };
  xmlhttp.open('POST', `./assets/php/products.php?category=${category}`, true);
  xmlhttp.send();
}
