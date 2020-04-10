document.addEventListener('click', function (e) {
  if (e.target.className.includes('feature-products__add')) {
    const product_id = e.target.parentElement.dataset.id;
    addToCart(product_id);
  }
});

const cart = {
  // Key should be randomized in a real project. Used as reference point and unique identifier
  key: 'qwerqwerqwerqwerqwerqwer',
  products: [],
};

async function addToCart(id) {
  const response = await fetch(`./assets/php/addToCart.php?id=${id}`);
  const product = await response.json();

  let tempObj = {
    name: product[0].name,
    price: product[0].price,
    image: product[0].image,
  };

  cart.products.push(tempObj);
  renderCart();
}

const renderCart = () => {
  const items = document.querySelector('.cart-fixed__cart-items');
  console.log(cart.products);

  items.innerHTML = '';
  cart.products.forEach((item) => {
    items.innerHTML += `<li class="cart-fixed__item">
                            <div class="cart-fixed__name">${item.name}</div>
                            <div>${item.price} kr</div>
                            <span class="cart-fixed__remove-btn">remove</span>
                          </li>`;
  });
};
