<?php
//Chargement du flux RSS

function get_page($url) {
		$curl = curl_init();
     
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$output = curl_exec($curl);
		if($output === false) {
			trigger_error('Erreur cURL : '.curl_error($curl),E_USER_WARNING);
		}
		curl_close($curl);
		return ($output);
	}

$output = get_page('http://flux.20minutes.fr/c/32497/f/479493/index.rss?xts=290428&xtor=RSS-1');
$xml = simplexml_load_string($output);
//echo $xml->getNamespaces();
foreach ($xml->children() as $valeur) {
	foreach ($valeur->children() as $valeur2) {
		if ($valeur2->getName() == "item") {
			echo "*******************************<br/>";
			echo $valeur2->title . "<br/>";
			echo $valeur2->description . "<br/>";
			echo $valeur2->link . "<br/>";
			echo "*******************************<br/>";
		}
		else {
			echo $valeur2->getName() . "<br/>";
		}
	}
}
?>


