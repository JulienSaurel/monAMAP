<?php  if (isset($_SESSION['administrateur'])) { ?>

<h1>Gestion des Administrateurs</h1>


<?php 

//var_dump($tab);

foreach ($tab as $key) {

	// var_dump($key);
	// echo'</br>';
	// echo'</br>';
	// echo'</br>';

	echo '<div><ul>';
	if ($key->get('photo') == NULL){
				echo 'L\'article ne comporte pas de photo';
			} else {
				echo '<img class="imgprofil" src= "'. $key->get('photo') . '" alt="' . $key->get('idArticle'). '"/>'; 
			}
	echo '<li> Titre : ' . $key->get('titreArticle') . '</li>';
	echo '<li> Date : ' . $key->get('date') . '</li>';
	echo '<li> description : ' . $key->get('description') . '</li>';
	echo '<li> Mail de l\'auteur : ' . $key->get('idPersonne') . '</li>';
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