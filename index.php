<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8'); 
	function aff_default($allArticle) {
		//print_r($allArticle);
		require 'Views/default.php';
	}



	
	
	try {
		require 'Model/UserManager.php';
		require 'Model/ArticleManager.php';
		
		/* 
		Condition de verification de variable url, si elles sont presentent 
		on charge la vue film sinon on charge le vue home.
		*/
		if (isset($_POST["searchContent"])) {
			$model = new ArticleManager();
			$tag = (String)$_POST["searchContent"];
			$allArticle = $model->searchArticle($tag);
			aff_default($allArticle);
		}
		else {
			aff_default(null);
		}
	}
	catch (Exception $e) {
		$msg_error = $e->getMessage();
		require 'Views/error.php';
	}
?>