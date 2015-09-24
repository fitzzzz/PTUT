<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Ceci se passe de commentaire.
-->
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="Content-Language" content="fr" />
 <meta name="author" content="Marc Glisse" />
 <title>
  Squelette
 </title>
</head>
<body>
<?php
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

	
	$output = get_page("http://www.20minutes.fr/insolite/1586147-20150414-probleme-maths-singapour-agite-toile-mondiale");
	$output = get_page($url);
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
	
	echo $test3 . $test4;
	
?>
</body>
</html>






