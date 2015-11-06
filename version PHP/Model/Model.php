<?php
$error_message = '';

abstract class		Model {
	private	static	 	$bdd;

	/*
		Execute une requette sql et renvoi le résultat de type : PDOStatement
	*/
	protected function	executeRequest($sql, $params = NULL) {
		if ($params == null) {
            $resultat = self::getBdd()->query($sql);   // exécution directe
        }
        else {
            $resultat = self::getBdd()->prepare($sql); // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
	}
	
	/*
	Renvoi l'objet PDO de connection à la BDD 
	*/
	private	static	function getBdd() {
		if (self::$bdd == null) {
			require 'bin/Log.php';
			self::$bdd=new PDO ('mysql:host=' . $host .'; dbname=' . $nombase  , $user , $password);
			self::$bdd->exec('SET NAME utf8');
			self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return (self::$bdd);
	}
}
?>