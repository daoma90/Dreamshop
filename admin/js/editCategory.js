function populateForm(id) {
  const category = document.querySelector("#cat-" + id);
  const form = document.querySelector(`.form-container__form`);
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
