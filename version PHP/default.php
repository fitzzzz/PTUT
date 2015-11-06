<?php
	$title='Accueil';
	ob_start();
?>	

<?php 
if (isset($allArticle)) { 
	foreach ($allArticle as $item) {
?>
	<p>
		<h3><?php echo $item['title']?></h3>
		<?php echo $item['description']?>
		<a href="<?php echo $item['link'];?>">Lien vers l'article</a>
	</p>
<?php }} ?>

<?php 
$content = ob_get_clean();
require 'Views/layout.php'; 
?>