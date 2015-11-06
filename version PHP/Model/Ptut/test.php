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

	
	/*
	function get_page($url) {
		
		$curl = curl_init();
     
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);

		curl_setopt($curl, CURLOPT_GET, true);
		$output = curl_exec($curl);
		if($output === false) {
			trigger_error('Erreur cURL : '.curl_error($curl),E_USER_WARNING);
		}
		curl_close($curl);
		return ($output);
	}

	
	$request_url ='https://www.google.fr/search?q=google&ie=utf-8&oe=utf-8&gws_rd=cr&ei=5nptVZo7xfjLA77AgagG#tbm=nws&q=20+minutes+test';
	$output = get_page(utf8_encode($request_url));
	echo $output;
	*/
 ?>
 
 
<script>
  (function() {
    var cx = '006780314432328108700:pxs9u7sljj0';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
 
 
 <script type="text/javascript">
document.getElementById("gsc-i-id1").value = "20 minutes test";
//document.getElementById("tsf").submit();
//googleSubmit.elements["btnG"].click();

//var arr = [], l = document.links;
//for(var i=0; i<l.length; i++) {
  //arr.push(l[i].href);
  //document.write(l[i].href);
  //document.write("</br>");
//}
</script>

</body>
</html>
