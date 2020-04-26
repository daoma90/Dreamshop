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

    // The length property of the from method is 1.
    return function from(arrayLike /*, mapFn, thisArg */) {
      // 1. Let C be the this value.
      var C = this;

      // 2. Let items be ToObject(arrayLike).
      var items = Object(arrayLike);

      // 3. ReturnIfAbrupt(items).
      if (arrayLike == null) {
        throw new TypeError(
          "Array.from requires an array-like object - not null or undefined"
        );
      }

      // 4. If mapfn is undefined, then let mapping be false.
      var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
      var T;
      if (typeof mapFn !== "undefined") {
        // 5. else
        // 5. a If IsCallable(mapfn) is false, throw a TypeError exception.
        if (!isCallable(mapFn)) {
          throw new TypeError(
            "Array.from: when provided, the second argument must be a function"
          );
        }

        // 5. b. If thisArg was supplied, let T be thisArg; else let T be undefined.
        if (arguments.length > 2) {
          T = arguments[2];
        }
      }

      // 10. Let lenValue be Get(items, "length").
      // 11. Let len be ToLength(lenValue).
      var len = toLength(items.length);

      // 13. If IsConstructor(C) is true, then
      // 13. a. Let A be the result of calling the [[Construct]] internal method of C with an argument list containing the single item len.
      // 14. a. Else, Let A be ArrayCreate(len).
      var A = isCallable(C) ? Object(new C(len)) : new Array(len);

      // 16. Let k be 0.
      var k = 0;
      // 17. Repeat, while k < len… (also steps a - h)
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
      // 18. Let putStatus be Put(A, "length", len, true).
      A.length = len;
      // 20. Return A.
      return A;
    };
  })();
}

const form = document.querySelector(".form-container__form");

/* function populateCategoryForm(id) {
  const category = document.querySelector(`#cat-${id}`);
  Array.from(form.elements).forEach(function (item) {
    switch (item.name) {
      case "name":
        item.value = category.querySelector(".cat-container__text").innerText;
        break;
    }
  });

  form.setAttribute("action", "./category/categoriesUpdate.php");
  form.querySelector("input[type='submit']").setAttribute("name", "updateCat");
  document.querySelector(".form-container__headline").textContent =
    "Update category";
  document.querySelector("#cat-id").setAttribute("value", id);
  form.parentElement.style.display = "initial";
} */

const add = document.querySelector(".section-add-imgwrap");
add.addEventListener("click", function (e) {
  form.parentElement.style.display = "block";
  form.querySelector("input[type='submit']").setAttribute("value", "Create");
  catCards = document.querySelectorAll(".cat-container");
  catCards = Array.from(catCards);
  catCards.forEach(function (item) {
    item.style.display = "none";
  });
});

const close = document.querySelector("#close");
close.addEventListener("click", function (e) {
  if (form.querySelector("input[type='submit']").name == "updateCat") {
    form.setAttribute("action", "./category/categoriesCreate.php");
    form.querySelector("input[type='submit']").setAttribute("name", "addCat");
    document.querySelector(".form-container__headline").textContent =
      "New Category";
    form.reset();
    form.parentElement.style.display = "none";
  } else {
    form.parentElement.style.display = "none";
  }

  catCards = document.querySelectorAll(".cat-container");
  catCards = Array.from(catCards);
  catCards.forEach(function (item) {
    item.style.display = "block";
  });
  document.querySelector(".form-container__img").src = "";
});

form
  .querySelector('input[type="submit"]')
  .addEventListener("click", function () {
    document.querySelector(".form-container__img").src = "";
  });

function editCategory(id) {
  form.setAttribute("action", "./category/categoriesUpdate.php");
  form.querySelector("input[type='submit']").setAttribute("name", "updateCat");
  form.querySelector("input[type='submit']").setAttribute("value", "Edit");
  document.querySelector(".form-container__headline").textContent =
    "Update category";
  document.querySelector("#cat-id").setAttribute("value", id);
  form.parentElement.style.display = "block";

  const category = document.querySelector("#cat-" + id);
  Array.from(form.elements).forEach(function (item) {
    switch (item.name) {
      case "name":
        item.value = category.querySelector(".cat-container__text").innerText;
        break;
    }
  });

  catCards = document.querySelectorAll(".cat-container");
  catCards = Array.from(catCards);
  catCards.forEach(function (item) {
    item.style.display = "none";
  });

  categoryImg = category.firstElementChild.firstElementChild.getAttribute(
    "src"
  );
  formImg = document.querySelector(".form-container__img");
  formImg.src = categoryImg;
}

//Show edit text when hovering a category
catHover = document.querySelectorAll(".cat-container");
catEditText = document.querySelector(".cat-container__edit-text");

for (let i = 0; i < catHover.length; i++) {
  cat = catHover[i];
  catHover[i].addEventListener("mouseover", function (e) {
    this.childNodes[1].childNodes[3].style.visibility = "visible";
  });
}

for (let i = 0; i < catHover.length; i++) {
  catHover[i].addEventListener("mouseout", function (e) {
    this.childNodes[1].childNodes[3].style.visibility = "hidden";
  });
}
