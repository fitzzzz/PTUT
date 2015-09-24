<?php
require_once('Model/Model.php');

class ArticleManager extends Model {


	function 	searchArticle($tag) {
		$url = "http://flux.20minutes.fr/c/32497/f/479493/index.rss?xts=290428&xtor=RSS-1";
		$page = $this->getPageFromURL($url);
		$allArticle = $this->getAllArticleFromRSS($page);
		//echo $allArticle[0]["description"];
		for ($i = 0; $i < count($allArticle); $i++) {
			if (strpos(strtolower($allArticle[$i]["description"]), strtolower($tag)) === false) {
				unset($allArticle[$i]);
				//echo "coucou";
			}
		}
		$allArticle = array_values($allArticle);
		//print_r($allArticle);
		return ($allArticle);
	}

	function 	getAllArticleFromRSS($output) {
		$xml = simplexml_load_string($output);
		foreach ($xml->children() as $valeur) {
			foreach ($valeur->children() as $valeur2) {
				if ($valeur2->getName() == "item") {
					$article["title"] = $valeur2->title;
					$article["description"] = $valeur2->description;
					$article["link"] = $valeur2->link;
					$allArticle[] = $article;
					/*
					echo "*******************************<br/>";
					echo v . "<br/>";
					echo $valeur2->description . "<br/>";
					echo $valeur2->link . "<br/>";
					echo "*******************************<br/>";
					*/
				}
				else {
					/*
					echo $valeur2->getName() . "<br/>";
					*/
				}
				
			}
		}
		return ($allArticle);
	}
	private function 	getPageFromURL($url) {
		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

	function   	getTextFrom20Minutes($output) {
		$doc = new DOMDocument();
		$doc->strictErrorChecking = FALSE;
		@$doc->loadHTML($output);
		$xml = simplexml_import_dom($doc);
		$body = $xml->body;
		foreach($body->div as $div) {
			if ($div['id'] == "content") {
				foreach($div->div as $div2) {
					if ($div2['id'] == "page-content") {
						foreach($div2->div as $div3) {
							if ($div3['class'] == "lt-page article default") {
								$titre = $div3->h1;
								foreach($div3->div as $div4) {
									if ($div4['class'] == "lt-content w66") {
										foreach($div4->children() as $content) {
											if ($content->getName() == "p") {
												$article = $article . $content . "</br>" ;
											}
											if ($content->getName() == "h2") {
												$article = $article . "<h2>" . $content . "</h2></br>" ;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		$content = array(
			"titre"	=> $text,
			"text"	=> $article
			);
		return ($content);
	}

	function 	getHTMLFrom20minutes($output) {
		$start = stripos($output, '<div class="lt-page article');
		$end = stripos($output, '<div class="page-over clr');
		$test = substr($output, $start, $end-$start);
	//echo $test;
		$start2 = stripos($test, '<div class="lt-page article');
		$end2 = stripos($test, '<ul class="content-related buzz mt2">');
		$test2 = substr($test, $start2, $end2-$start2);
	//echo $test2;
		$start3 = stripos($test2, ' <h1>');
		$end3 = stripos($test2, '<ul class="content-related buzz mb2">');
		$test3 = substr($test2, $start3, $end3-$start3);
	//echo $test3;

		$start4 = stripos($test, '<div class="lt-content w66"');
    //echo $start4;
		$end4 = stripos($test, '<ul class="content-related buzz mt2">');
		$test4 = substr($test2, $start4, $end4-$start4);
	//echo $end4;

		//echo $test3 . $test4;
		return (test3 + test4);
	}

}
?>