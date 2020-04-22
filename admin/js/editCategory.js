const form = document.querySelector(`.form-container__form`);

function populateCategoryForm(id) {
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
}

const add = document.querySelector(".section-add-imgwrap");
add.addEventListener("click", function (e) {
  form.parentElement.style.display = "initial";
});

const close = document.querySelector("#close");
close.addEventListener("click", function (e) {
  if (form.querySelector("input[type='submit']").name == "updateCat") {
    form.setAttribute("action", "./category/categoriesCreate.php");
    form.querySelector("input[type='submit']").setAttribute("name", "addCat");
    document.querySelector(".form-container__headline").textContent =
      "New Category";
    form.reset();
  } else {
    form.parentElement.style.display = "none";
  }
});
