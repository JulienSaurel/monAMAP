<?php  if (isset($_SESSION['administrateur'])) { ?>

<h1>Gestion des Articles</h1>


<?php 

//var_dump($tab);

foreach ($tab as $key) {

	// var_dump($key);
	// echo'</br>';
	// echo'</br>';
	// echo'</br>';
	$idp = $key->get('idArticle');
	echo '<div><ul>';
	if ($key->get('photo') == NULL){
				echo 'L\'article ne comporte pas de photo';
			} else {
				echo '<img class="imgprofil" src= "'. $key->get('photo') . '" alt="' . $key->get('idArticle'). '"/>'; 
			}
	echo '<li> Titre : ' . $key->get('titreArticle') . '</li>';
	echo '<li> description : ' . $key->get('description') . '</li>';
	echo '<li> Mail de l\'auteur : ' . $key->get('idPersonne') . '</li>';
	echo '<li> Date : ' . $key->get('date') . '</li>';
	echo '</ul>';
	echo '  <a href=?action=updateArt&controller=admin&idArticle=' . $idp . '> Modifier</a>  | <a href=?action=deleteArt&controller=admin&idArticle=' . $idp . '> Supprimer</a>';
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