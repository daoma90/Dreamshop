// Production steps of ECMA-262, Edition 6, 22.1.2.1
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
      // 13. a. Let A be the result of calling the [[Construct]] internal method
      // of C with an argument list containing the single item len.
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

//Deletes element in DOM and database
function deleteView(id) {
  const element = document.querySelector("#product_" + id);
  event.preventDefault();
  let req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      setTimeout(function () {
        element.remove();
      }, 250);
    }
  };
  if (confirm("Säker på att du vill ta bort?")) {
    req.open("POST", "../product/productDelete.php?ID=" + id, true);
    req.send();
  }
}

//Populate all data from DOM to form and change to updateproduct.php
const toggle = document.querySelector("#form-toggle");
const form = document.querySelector(`.f-container__form`);

function populateFields(id) {
  const form = document.querySelector(".f-container__form");
  const product = document.querySelector("#product_" + id);
  const children = product.children[1].children;
  Array.from(form.elements).forEach(function (input) {
    Array.from(children).forEach(function (row) {
      if (input.name === row.className) {
        if (input.name !== "image") {
          input.value = row.textContent;
        }
        if(input.name === "featured") {
          input.selectedIndex = parseInt(row.textContent);
        }
      }
    });
  });
  //Set form to update mode
  form.setAttribute("action", "productUpdate.php");
  form.querySelector("button").setAttribute("name", "updateProduct");
  document.querySelector("#upID").setAttribute("value", id);
  document.querySelector(".f-container__form-header").textContent =
    "Update product";
  document.querySelector(".f-container__form-submit").textContent = "Update";
  toggle.style.display = "block";
}

//Resets form back to create mode
toggle.addEventListener("click", function (e) {
  toggle.style.display = "none";
  form.setAttribute("action", "productCreate.php");
  form.querySelector("button").setAttribute("name", "addProduct");
  document.querySelector(".f-container__form-header").textContent =
    "Create product";
  document.querySelector(".f-container__form-submit").textContent = "Create";
  form.reset();
});
