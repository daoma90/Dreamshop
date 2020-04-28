function responseMessage(text) {
	const element = document.createElement("div");
	element.className = "repsonse_container"
	element.innerHTML = text;
	document.querySelector("body").appendChild(element);
	return true;
}