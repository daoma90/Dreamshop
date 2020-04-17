if (!Array.from) {
  Array.from = (function () {
    var toStr = Object.prototype.toString;
    var isCallable = function (fn) {
      return typeof fn === "function" || toStr.call(fn) === "[object Function]";
    };
    var toInteger = function (value) {
      var number = Number(value);
      if (isNaN(number)) {
        return 0;
      }
      if (number === 0 || !isFinite(number)) {
        return number;
      }
      return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
    };
    var maxSafeInteger = Math.pow(2, 53) - 1;
    var toLength = function (value) {
      var len = toInteger(value);
      return Math.min(Math.max(len, 0), maxSafeInteger);
    };

    return function from(arrayLike /*, mapFn, thisArg */) {
      var C = this;

      var items = Object(arrayLike);

      if (arrayLike == null) {
        throw new TypeError(
          "Array.from requires an array-like object - not null or undefined"
        );
      }

      var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
      var T;
      if (typeof mapFn !== "undefined") {
        if (!isCallable(mapFn)) {
          throw new TypeError(
            "Array.from: when provided, the second argument must be a function"
          );
        }
        if (arguments.length > 2) {
          T = arguments[2];
        }
      }
      var len = toLength(items.length);
      var A = isCallable(C) ? Object(new C(len)) : new Array(len);

      var k = 0;
      var kValue;
      while (k < len) {
        kValue = items[k];
        if (mapFn) {
          A[k] =
            typeof T === "undefined"
              ? mapFn(kValue, k)
              : mapFn.call(T, kValue, k);
        } else {
          A[k] = kValue;
        }
        k += 1;
      }
      A.length = len;
      return A;
    };
  })();
}

function populateCategoryForm(id) {
  const category = document.querySelector("#cat-" + id);
  const form = document.querySelector(".form-container__form");
  console.log(form.elements);
  Array.from(form.elements).forEach(function (item) {
    switch (item.name) {
      case "name":
        item.value = category.querySelector(".cat-container__text").innerText;
        break;
      //   case "image":
      //     item.value = category
      //       .querySelector(".cat-container__img")
      //       .getAttribute("src");
      //     break;
    }
    if (item.type === "submit") {
      item.innerText = "Uppdatera";
    }
  });

  form.setAttribute("action", "categoriesUpdate.php");
  form
    .querySelector(".form-container__submit")
    .setAttribute("name", "updateCat");
  document.querySelector(".form-container__headline").textContent =
    "Uppdatera Kategori";
  document.querySelector("#cat-id").setAttribute("value", id);
}
