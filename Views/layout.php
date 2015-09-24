<!DOCTYPE html>
<HTML >
<HEAD >
 <meta charset="UTF-8"> 

<link rel="stylesheet" type="text/css" href="Web/CSS/MenuStyles.css">
<TITLE > <?php echo $title; ?> </TITLE >
</HEAD >
<BODY >
	<div id="applicationTitle">
		<h1> Resume intelligent des nouvelles du jour </h1>
	</div>
	<div id='cssmenu'>
		<ul>
			<li class='active'><a href='#'>Accueil</a></li>
			<li><a href='#'>Connexion</a></li>
		</ul>
	</div>
	<form method="post" action="./index.php">
		<input type="text" name="searchContent"/>
		<input type="submit" value="Rechercher"/>
	</form>

	<section id="article">
		<?php echo $content ?>
	</section>
	<footer>
	Site créé exclusivement en PHP5, HTML5 et CSS3
	</footer>
</BODY>
</html>