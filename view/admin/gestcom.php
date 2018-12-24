<?php  if (isset($_SESSION['administrateur'])) { ?>

<h1>Gestion des Administrateurs</h1>


<?php 

//var_dump($tab);

foreach ($tab as $key) {

	echo '<div><ul>';
	echo '<li> id_message : ' . $key->get('id_message') . '</li>';
	echo '<li> pseudo : ' . $key->get('pseudo') . '</li>';
	echo '<li> message : ' . $key->get('message') . '</li>';
	echo '</ul></div>';

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