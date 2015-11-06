<?php
	header('Content-Type: text/html; charset=utf-8');
	try
	{
		if(isset($_GET['url'])) {
			require 'content.php';
		} 
		else {
			require 'ptuthome.php';
		}
	}
	catch (Exception $e)
	{
		ob_start();
		$msg = $e->getMessage();
		require 'ptuterror.php';
		$content = ob_get_clean();
		require 'ptutlayout.php';
	}