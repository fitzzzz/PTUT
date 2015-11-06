function ReaderRSS(content, provider) {
	var parser = new DOMParser();
	this.provider = provider;
	try {
		new SimpleXmlElement($content);
	} catch (e) {
		
	}
	this.content = parser.parseFromString(content, "text/xml");

}

ReaderRSS.prototype.parseRSS = function() {
	var allArticles = this.content.getElementsByTagName("item");
	var index;
	var article;
	var response = [];

	for (index = 0; index < allArticles.length; index++) {
		article = this.parseArticle(allArticles[index]);
		response.push(article);
	} 
	return (response);
};

ReaderRSS.prototype.parseArticle = function(content) {
	var article = [];
	var enclosureType = "";

	var descriptionText =  content.getElementsByTagName("description")[0].textContent;
	if (this.provider == "monde")
		descriptionText = descriptionText.substr(0, descriptionText.indexOf("."));
	else if (this.provider == "01net")
		descriptionText = descriptionText.substr(0, descriptionText.indexOf("<br/>"));
	article["title"] = content.getElementsByTagName("title")[0].textContent;
	article["description"] = descriptionText;
	article["link"] = content.getElementsByTagName("link")[0].textContent;
	article["pubdate"] = content.getElementsByTagName("pubDate")[0].textContent;
	article["provider"] = this.provider;
	
	article["enclosureURL"] = null;
	article["enclosureType"] = null;
	if (content.getElementsByTagName("enclosure").length > 0) {
		article["enclosureURL"] = content.getElementsByTagName("enclosure")[0].getAttribute("url");
		article["enclosureType"] = content.getElementsByTagName("enclosure")[0].getAttribute("type");
	}
	return (article);
};
