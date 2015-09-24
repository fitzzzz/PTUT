<?php
require_once('Model/Model.php');

class UserManager extends Model {

/*
	utiliser cript
*/

/* 
	Renvoi tous les films de la BDD sous forme d'Array 
	*/
	function		getPassword($login) {
		$req = $this->executeRequest('SELECT Pass FROM Utilisateur WHERE Login = "' . $login . '"');
		$donnees = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
		if (isset($donnees[0]["Pass"]))
			return ($donnees[0]["Pass"]);
		return (NULL);
	}
	
	function		getUserId($login) {
		$req = $this->executeRequest('SELECT UserID FROM Utilisateur WHERE Login = "' . $login . '"');
		$donnees = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return ($donnees[0]["UserID"]);
	}
	
	/* 
	Renvoi le nombre de films contenus dans la BDD 
	*/
	function	checkConnection() {
		$req = $this->executeRequest('SELECT Titre, Annee, Score, Votes FROM Movie');
		$count = $req->rowCount();
		$req->closeCursor();
		return ($count);
	}
}
?>