//Deletes element in DOM and database
function deleteView(id) {
	const element = document.querySelector(`#product_${id}`)
	const formData = new FormData();
	formData.append('ID', id);
	event.preventDefault();
	fetch("productDelete.php", {
			method: 'POST',
			body: formData
		})
		.then(function(response) {
			if (response.ok) {
				if (confirm("Säker på att du vill ta bort?"))
					setTimeout(() => {
						element.remove();
					}, 250);

			} else {
				alert("Error with DB");
			}
		});
}


//To show tags
const addCategoryTag = () => {
	const tags = document.querySelectorAll(".category-tag");
	tags.forEach(tag => {
		//tag.innerText = "some value from dom?";
	});
}

//Populate all data from DOM to form and change to updateproduct.php
function populateFields (id) {
	const element = document.querySelector(`#product_${id}`);
	const form = document.querySelector(`.f-container__form`);
	Array.from(form.elements).forEach(function(item) {
		switch (item.name) {
			case "image":
				item.setAttribute("src", element.querySelector("img").getAttribute("src"));
				break;
			case "name":
				item.value = element.querySelector(".name").innerText;
				break;
			case "description":
				item.value = element.querySelector(".desc").innerText;
				break;

			case "price":
				item.value = element.querySelector(".price").innerText;
				break;

			case "in_stock":
				item.value = element.querySelector(".in_stock").innerText;
				break;

			case "featured":
				item.value = element.querySelector(".featured").innerText;
				break;
			default:
				break;
		}
		if(item.type === "submit") {
			item.innerText = "Update post";
		}
	});

	form.setAttribute("action", "productUpdate.php");
	form.querySelector("button").setAttribute("name", "updateProduct");
	document.querySelector("#upID").setAttribute("value", id);
	document.querySelector(".f-container__form-header").textContent = "Update product";
	//set some edit styling to indicate in edit..
}