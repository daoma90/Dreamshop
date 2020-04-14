document.addEventListener('click', function (e) {
  if (e.target.className.includes('lp-categories__')) {
    const category = e.target.parentElement.querySelector(
      '.lp-categories__title'
    ).textContent;

    getProducts(category);
  }
  if (e.target.className.includes('catsort-header')) {
    const category = e.target.textContent;
    getProducts(category);
    menu.classList.remove('burger-visible');
  }
});

async function getProducts(category) {
  const response = await fetch(
    `./assets/php/products.php?category=${category}`,
    { method: 'post' }
  );
  const data = await response.text();

  if (data) {
    const categoryTitle = document.querySelector(
      '.lp-products__current-category'
    );

    document.querySelector('.lp-products__wrap').innerHTML = data;

    categoryTitle.textContent = category;
    categoryTitle.scrollIntoView();
  }
}
