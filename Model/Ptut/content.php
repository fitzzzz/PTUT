<?php
	$url = $_GET['url'];
	require 'algo_2.php';
	
	//$output = get_page($url);
	//$content = get_content_20min($output);
	
		//echo "<h1>" . $content["titre"] . "</h1></br>";
			echo $content["titre"] . "</br>";
	echo $content["article"];
?>