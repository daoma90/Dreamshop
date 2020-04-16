HappyLib = (function () {
  const version = 'v0.1';
  const description =
    'Nice-to-have functions when handling a cart with localStorage and *.json-data.';
  const author = 'Patric Ronge & Samuel Mårtensson';

  const HappyLib = {
    addEvents: function (element, func, type) {
      if (window.document.documentMode) {
        element = Array.prototype.slice.call(element);
      }
      element.forEach(function (e) {
        e.addEventListener(type, function (e) {
          func(e);
        });
      });
    },

    findProduct: function (name, db) {
      let foundProduct = db.products.filter(function (item) {
        if (name === item.name) {
          return item;
        }
      });
      return foundProduct[0];
    },

    localStorageInit: function (key) {
      let products = localStorage.getItem(key);
      if (products) {
        cart.products = JSON.parse(products);
        return true;
      }
    },

    updateLocalStorage: function (key, cb) {
      const tempStr = JSON.stringify(cart.products);
      localStorage.setItem(key, tempStr);
      if (cb) {
        cb();
      }
    },

    getTotalPrice: function (items) {
      let price = 0;
      items.forEach(function (item) {
        price += item.price * item.quantity;
      });
      return price;
    },

    getTotalQty: function (items) {
      let total = 0;

      items.forEach(function (item) {
        total += parseInt(item.quantity);
      });
      return total;
    },
  };

  return HappyLib;
})();
