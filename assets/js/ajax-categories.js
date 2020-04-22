document.addEventListener('click', function (e) {
  if (e.target.className.includes('lp-categories__')) {
    const category = e.target.parentElement.querySelector(
      '.lp-categories__title'
    ).textContent;

    getProducts(category);
  }
  if (e.target.className.includes('catsort')) {
    const category = e.target.textContent;
    console.log('hs');
    if (document.querySelector('.productpage')) {
      window.location = './?category=' + category;
      window.location.hash = '#category';
    }
    getProducts(category);
    menu.classList.remove('burger-visible');
    burger.classList.remove('header__nav--active');
  }
});

// async function getProducts(category) {
//   const response = await fetch(
//     `./assets/php/products.php?category=${category}`,
//     { method: 'post' }
//   );
//   const data = await response.text();

//   if (data) {
//     const categoryTitle = document.querySelector(
//       '.lp-products__current-category'
//     );

//     document.querySelector('.lp-products__wrap').innerHTML = data;

//     categoryTitle.textContent = category;
//     categoryTitle.scrollIntoView();
//     window.scrollBy(0, -72);
//   }
// }
function getProducts(category) {
  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const categoryTitle = document.querySelector(
        '.lp-products__current-category'
      );
      document.querySelector(
        '.lp-products__wrap'
      ).innerHTML = this.responseText;
      categoryTitle.textContent = category;
      categoryTitle.scrollIntoView();
      window.scrollBy(0, -72);
    }
  };
  request.open('POST', './assets/php/products.php?category=' + category, true);
  request.send();
}
