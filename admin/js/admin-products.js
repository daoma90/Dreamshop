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
    return function from(arrayLike /*, mapFn, thisArg */ ) {
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
            typeof T === "undefined" ?
            mapFn(kValue, k) :
            mapFn.call(T, kValue, k);
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
//const form = document.querySelector(".f-container__form");
const toggle = document.querySelector("#form-toggle");
const productForm = document.querySelector(".product-form-main");

function populateFields(id) {
  //const form = document.querySelector(".f-container__form");
  const product = document.querySelector("#product_" + id);
  const children = product.children[1].children;
  //Goes throuh DOM products, (validation needed here?)
  Array.from(productForm.elements).forEach(function (input) {
    Array.from(children).forEach(function (row) {
      if (input.name === row.className) {
        if (input.name !== "image") {
          input.value = row.textContent;
        }
        if (input.name === "featured") {
          input.selectedIndex = parseInt(row.textContent);
        }
      }
    });
    //Sets preview image
    if (input.name = "image") {
      document.querySelector(".product-form-main__left-img img").
      setAttribute("src", product.firstElementChild.children[0].firstElementChild.
      getAttribute("src"));
    }
  });

  product.style.zIndex = "900";
  product.style.display = "flex";
  productForm.setAttribute("action", "productUpdate.php");
  productForm.querySelector("button").setAttribute("name", "updateProduct");
  document.querySelector("#upID").setAttribute("value", id);
  toggle.style.display = "block";
  product.appendChild(productForm);

  //Hides all products and reset width except current one, 
  const allProducts = document.querySelectorAll(".product");
  allProducts.forEach(function (p) {
    let isCurrent = p.id == "product_" + id;
    if (!isCurrent) {
      p.style.opacity = "0.5";
      p.style.minwidth = "550px";
    } else {
      p.style.opacity = "1";
      p.style.minwidth = "450px";
    }
  });
}

//Resets form back to create mode
toggle.addEventListener("click", function (e) {
  toggle.style.display = "none";
  productForm.setAttribute("action", "productCreate.php");
  productForm.querySelector("button").setAttribute("name", "addProduct");
  productForm.reset();
});

//Opens create form
const add = document.querySelector(".section-add-imgwrap");
add.addEventListener("click", function (e) {
  productForm.setAttribute("action", "productCreate.php");
  productForm.querySelector("button").setAttribute("name", "addProduct");
  productForm.querySelector("h2").textContent = "Create product";
  productForm.parentElement.style.display = "flex";
});