function WriterRSS(allArticles, url) {
	this.allArticles = allArticles;
	this.enCours = null;
	this.url = url;
}


WriterRSS.prototype.removeOldArticles = function () {
	var old = document.getElementById("content");
	while (old.firstChild) {
		old.removeChild(old.firstChild);
	}
}

WriterRSS.prototype.writeRSS = function () {
	var index;

	this.removeOldArticles();
	var combobox = window.document.getElementById("choix");
	var choix = combobox.options[combobox.selectedIndex].value;
	for (index = 0; index < this.allArticles.length; index++) {
		if (this.allArticles[index] != undefined) {
			var i = 0;
			for (var found = 0; i < this.allArticles[index].length && found == 0; i++) {
				if (this.allArticles[index]["provider"] == choix) {
					found = 1;
				}
			}
			if (found == 1)  {
				this.writeArticle(this.allArticles[index], index, i);
			}
			else
				this.writeArticle(this.allArticles[index], index, 0);
		}
	}
}

WriterRSS.prototype.writeArticle = function (article, id, priorite) {
	var element = document.getElementById("content");
	var art = document.createElement("article");
	var para = document.createElement("p");
	var titre = document.createElement("h1");
	var link = document.createElement("a");
	var textLink = document.createTextNode("Lien vers l'article");
	var textTitre = document.createTextNode(article[priorite]["provider"] + " : " + article[priorite]["title"]);
	var textDate = document.createTextNode(article[priorite]["pubdate"]);
	var textPara = document.createTextNode(article[priorite]["description"]);

	var media = null;
	if (article[priorite]["enclosureType"] !== null) {
		if (article[priorite]["enclosureType"].indexOf("audio") !== -1) {
			media = document.createElement("audio");	
			media.setAttribute("id", "media" + id);
			var source = document.createElement("source");
			source.setAttribute("src", article[priorite]["enclosureURL"]);
			source.setAttribute("type", article[priorite]["enclosureType"]);
			media.appendChild(source);
			media.setAttribute("controls", "controls");
		} else if (article[priorite]["enclosureType"].indexOf("video") !== -1) {
			media = document.createElement("video");
			media.setAttribute("id", "media" + id);
			var source = document.createElement("source");
			// pour css
			media.setAttribute("width", "320");
			media.setAttribute("height", "240");
			// pour css
			source.setAttribute("src", article[priorite]["enclosureURL"]);
			source.setAttribute("type", article[priorite]["enclosureType"]);
			media.setAttribute("controls", "controls");
			media.appendChild(source);
		} else if (article[priorite]["enclosureType"].indexOf("image") !== -1) {
			media = document.createElement("img");
			// pour css
			media.setAttribute("width", "320");
			media.setAttribute("height", "240");
			// pour css
			media.setAttribute("src", article[priorite]["enclosureURL"]);
		}
	}
	
	art.setAttribute("class", "article");
	link.setAttribute("href", article[priorite]["link"]);

	titre.appendChild(textTitre);
	link.appendChild(textLink);	
	para.appendChild(titre);
	para.appendChild(textDate);
	para.appendChild(document.createElement("br"));
	//element.innerHTML += article["description"];
	//para.innerHTML += article["description"];
	para.appendChild(textPara);
	art.appendChild(para);
	if (media !== null)
		art.appendChild(media);
	art.appendChild(link);
	// AJOUT DES LIENS SIMILAIRES
	if (article.length > 1) {
		var paraSimilar = document.createElement("p");
		var textParaSimilar = document.createTextNode("Articles similaires :");
		paraSimilar.appendChild(textParaSimilar);
		for (var i = 0; i < article.length; i++) {
			if (i != priorite) {
				var linkSimilar = document.createElement("a");
				var textLink = document.createTextNode(article[i]["provider"]+ " : " + article[i]["title"]); 
				linkSimilar.setAttribute("href", article[i]["link"]);
				linkSimilar.appendChild(textLink);
				paraSimilar.appendChild(linkSimilar);
			}			
		}
		art.appendChild(paraSimilar);
	}
	element.appendChild(art);
}

WriterRSS.prototype.addEvent = function() {
	var allMedia = null;

	allMedia = document.getElementsByTagName("video");
	if (allMedia.length === 0) 
		allMedia = document.getElementsByTagName("audio");
	for (var i = 0; i < allMedia.length; i++) {
		allMedia[i].addEventListener("play", function(evt) {
			if (this.enCours !== null && this.enCours !== undefined) {
				if (this.enCours !== evt.target.id)
					document.getElementById(this.enCours).pause();	
			}
			var index = window.location.hash.indexOf("&media");
			if (index != -1)
				window.location = window.location.hash.substr(0, index);
			window.location.replace(window.location + "&mediaID=" + evt.target.id);
			this.enCours = evt.target.id;
		}.bind(this));
	}
}