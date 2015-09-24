<?php $title = 'Erreur';
ob_start();

echo '<p class="err">Une erreur est survenue : ' . $msg . '</p>';

$content = ob_get_clean();
require 'ptutlayout.php';