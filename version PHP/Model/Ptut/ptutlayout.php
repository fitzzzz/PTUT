<!DOCTYPE HTML>
<HTML>
	<Head>
		<meta content="text/html" http-equiv="Content-Type" charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="mystyle.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<Title><?php echo $title ?></title>
	</head>
	<body>
		<h1>FyK : Feed Your Knowledge</h1>
		<nav>
			<ul>
				<li><a href="index.php">ACCUEIL</a></li>
				<li><a href="login.php">CONNEXION</a></li>
			</ul>
		</nav>
		<div>
		<form method="get" action="index.php?action=search">
			<ul>
				<li>
					<label for="sport">Sport</label>
					<input type="checkbox" name="sport" value="unchecked">
				</li>
				<li>
					<label for="science">Science</label>
					<input type="checkbox" name="science" value="unchecked">
				</li>
				<li>
					<input type="text" name="search" id="search" value="Recherche...">
					<input type="submit" value="Go !">
				</li>
				<li>
					<label for="plus récente">Les plus récentes</label>
					<input type="radio" name="plus récente" value="unchecked">
				</li>
				<li>
					<label for="plus populaire">Les plus populaires</label>
					<input type="radio" name="plus populaire" value="unchecked">
				</li>
			</ul>
		</form>
		</div>
		<section id="iframes">
			<iframe src="index.php?url=http://www.20minutes.fr/rennes/1554875-20150304-rennes-prof-maths-surdoue-releve-defi-tf1"></iframe>
			<iframe src="index.php?url=http://www.20minutes.fr/societe/1632415-20150616-stephane-richard-pdg-orange-porte-plainte-menaces-mort-hacker-ulcan-soupconne"></iframe>
			
			<!----- <iframe src="http://www.journaldugeek.com/"></iframe> ----->
		</section>
		<span>
		
		
		<section>
				<?php ?>
		</section>
	</body>
</html>