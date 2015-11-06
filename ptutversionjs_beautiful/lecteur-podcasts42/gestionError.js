function writeBadRequest(url) {
	var content = document.getElementById("content");

	var error = document.createElement("p");
	error.setAttribute("class", "error");
	var textError = document.createTextNode("Votre url: " +  url + " n'existe pas");
	error.appendChild(textError);
	content.appendChild(error);
}