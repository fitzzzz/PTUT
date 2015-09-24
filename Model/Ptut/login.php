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
				<li><a href="index.php?action=login">CONNEXION</a></li>
			</ul>
		</nav>

<form method="post" action="index.php?action=loginCheck">
   <p id="input_users">
		<input type="text" name="login" placeholder="Enter your username" /> <br />
		<input type="password" name="password" placeholder="Enter your password" />	<br />
		<input type="submit" value="Log In" />
	</p>
</form>
</body>
</HTML>
