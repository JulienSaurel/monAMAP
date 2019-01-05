<p>Votre message a bien été pris en compte.</p>
<?php
$page = 0;
$tab = ModelLivreDor::getAllBetween($page, $page + ModelLivreDor::getnbmsgpg());
$pagetitle = 'Livre d\'or';
$view = 'livredor';
require_once File::build_path(array('view','view.php')); ?>