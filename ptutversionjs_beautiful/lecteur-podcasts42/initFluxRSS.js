function initFluxRSS() {
	var allFlux = [];

	allFlux["20min"] = "http://crossorigin.me/http://www.20min.ch/rss/rss.tmpl?type=channel&get=6";
	allFlux["monde"] = "http://crossorigin.me/http://rss.lemonde.fr/c/205/f/3050/index.rss";
	allFlux["rue89"] = "http://crossorigin.me/http://api.rue89.nouvelobs.com/feed";
	allFlux["l'equipe"] = "http://crossorigin.me/http://www.lequipe.fr/rss/actu_rss.xml";
	allFlux["01net"] = "http://crossorigin.me/http://www.01net.com/rss/actualites/";
	return allFlux;
}
