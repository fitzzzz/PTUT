/*
* Constructeur de la class LecteurRSS
*/
function LecteurRSS() {
	//this.req = new XMLHttpRequest();
	this.allArticles = null;
}


/*
*  Ajoute / Ecrit un nouveau flux RSS dans la page
*
*/
LecteurRSS.prototype.send = function (url, critere, provider) {
	var req = new XMLHttpRequest();


	req.open("GET", url);
	req.setRequestHeader("Content-Type", "text/xml");
	req.onreadystatechange = function() {
		if (req.readyState === 4) {
			if (req.status === 200) {
				try {
					var type = req.getResponseHeader("Content-Type");
					if (type.indexOf("text/xml") == -1 && type.indexOf("application/rss+xml")) {
						console.log(type);
						throw "L'url n'est pas un flux RSS (XML)";	
					}

					var myReader = new ReaderRSS(req.responseText, provider);
					var newArticle = myReader.parseRSS();
					if (critere != "")
						newArticle = this.matchCritere(newArticle, critere);
					

					if (this.allArticles != null) {
						this.allArticles = this.allArticles.concat(newArticle);
					} else {
						this.allArticles = newArticle;
					}
					var allSepareArticles = this.separeSimilarArticle();
					this.sortArticle(allSepareArticles);
					var myWriter = new WriterRSS(allSepareArticles, url);
					myWriter.writeRSS();
					myWriter.addEvent();
				}
				catch (e) {
					console.log(e);
					writeBadRequest(url);
				}

			} else {
				console.log(req.status);
				writeBadRequest(url);
				//handle error 
			}
		}
	}.bind(this);
	req.send();
}

LecteurRSS.prototype.sortArticle = function (allSepareArticles) {
	for (var i = 0; i < allSepareArticles.length; i++) {
		allSepareArticles[i].sort(function (a, b) {
			if (a["title"].length > b["title"].length) 
				return 1;
			else if (a["title"].length > b["title"].length)
				return -1;
			else 
				return 0;
		});
	}
}

LecteurRSS.prototype.matchCritere = function (articles, critere) {
	var matchs = [];
	var lenghtArticles = articles.length;
	var found;

	for (var i = 0; i < lenghtArticles; i++) {
		found = 0;
		for (var a = 0; a < critere.length; a++) {
			if (articles[i]["title"].toLowerCase().indexOf(critere[a].toLowerCase()) >= 0 || articles[i]["description"].toLowerCase().indexOf(critere[a].toLowerCase()) >= 0) {
				found++;
				console.log("ca passe");
			}
			if (found >= critere.length )
				matchs.push(articles[i]);
		}
	}
	return matchs;
}

/*
* Recupère tous les parametres de l'url apres "#" et les mets 
* dans un tableau : tab["Nom Parametre"] = Valeur
*/
LecteurRSS.prototype.getHashParameters = function (hash, parameter) {
	var allParamater = [];

	if (hash.length > 1) {
		hash = hash.substr(1);
		hash = hash.split("&");
		for (var i = 0; i < hash.length; i++) {
			if (hash[i] !== "") {
				var parameter = hash[i].split("=");
				if (parameter.length === 2 && parameter[0].length !== 0 &&
					parameter[1].length !== 0) {
					allParamater[parameter[0]] = parameter[1];
			} else {
				writeBadRequest("mauvais parametre");
				return null;
			}
		}
	}
}
return (allParamater);
}

/*
* Recharge le contexte de la page se trouvant dans l'url après "#"
*/
LecteurRSS.prototype.reloadContext = function () {
	var allParamater = this.getHashParameters(window.location.hash);

	if (allParamater["url"] != null) {
		this.setNewUrl(allParamater["url"]);
		this.send();
	} else {
		console.log("pas de parametre url");
	}
}



LecteurRSS.prototype.calculPoids =  function (article1, article2) {
	var motArticle1 = article1["description"].split(" ");
	var poids = 0;

	motArticle1 = article1["title"].split(" ");
	motArticle2 = article2["title"].split(" ");
	for (var i = 0; i < motArticle1.length; i++) {
		for (var cpt = 0; cpt < motArticle2.length; cpt++) {
			if (motArticle1[i].length > 3 && motArticle2[cpt].length > 3) {
				if (motArticle1[i].indexOf(motArticle2[cpt]) !== -1 ||
					motArticle2[cpt].indexOf(motArticle1[i]) !== -1) {
					poids += motArticle1[i].length;
				}
			}			
		}
	}
	console.log(poids);
	return poids;
}

LecteurRSS.prototype.separeSimilarArticle = function () {
	var tmpAllArticles = this.allArticles.slice();
	var newArticle = [];
	
 	var i, a;

	while (tmpAllArticles.length > 0) {
		var similarArticle = [];
		similarArticle.push(tmpAllArticles[0]);
		i = 1;
		while (i <  tmpAllArticles.length) {
			if (this.calculPoids(tmpAllArticles[0], tmpAllArticles[i]) >= 20) {
				similarArticle.push(tmpAllArticles[i]);
				tmpAllArticles.splice(i, 1);
			} else {
				i++;
			}
		}
		i = 0;
		tmpAllArticles.splice(0, 1)
		while (i < similarArticle.length) {
			a = 0;
			while (a < tmpAllArticles.length) {
				if (this.calculPoids(tmpAllArticles[a], similarArticle[i]) >= 20) {
					similarArticle.push(tmpAllArticles[a]);
					tmpAllArticles.splice(a, 1);
				} else {
					a++;
				}
			}
			i++;
		}
		newArticle.push(similarArticle);
	}
	return newArticle;
}


LecteurRSS.prototype.search = function() {
	var old = document.getElementById("content");
	while (old.firstChild) {
		old.removeChild(old.firstChild);
	}
	this.allArticles = null;
	var choix = document.getElementById("choix");
	var critere = document.getElementById("search").value.split(" ");
	var allURL = initFluxRSS();
	for (var i = 0; i < choix.length ; i++) {
		this.send(allURL[choix[i].value], critere, choix[i].value);		
	}
}

LecteurRSS.prototype.main = function () {
	document.getElementById("searchButton").addEventListener("click", function() {this.search();}.bind(this));
	//window.addEventListener("load", function() {this.loadRSS(0);}.bind(this));
}

var monLecteur = new LecteurRSS();
monLecteur.main();




