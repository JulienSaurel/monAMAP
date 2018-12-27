<?php  if (isset($_SESSION['administrateur'])) { ?>

<h1>Gestion des Commentaires</h1>


<?php 

//var_dump($tab);

foreach ($tab as $key) {
	$idp=$key->get('id_message');
	echo '<div><ul>';
	echo '<li> id_message : ' . $key->get('id_message') . '</li>';
	echo '<li> pseudo : ' . $key->get('pseudo') . '</li>';
	echo '<li> message : ' . $key->get('message') . '</li>';
	echo '<a href=?action=deleteCom&controller=admin&id_message=' . $idp . '> Supprimer</a>';
	echo '</ul>';
	echo '</div>';

}
//var_dump($tab);

?>

<?php }

else {

?>

<li>Veuillez vous <a href="?action=connect&controller=adherent">connecter</a>, ou <a href="?action=create&controller=adherent">créer un compte.</a></li>

<?php

	}

?>