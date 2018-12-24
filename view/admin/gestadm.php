<?php  if (isset($_SESSION['administrateur'])) { ?>

<h1>Tous les Administrateurs</h1>


<?php 

foreach ($tab as $key) {
	if ($key->get('estAdministrateur') == 1){
	echo '<div><ul>';

	if ($key->get('photo') == NULL){
				echo 'Le producteur n\'a pas de photo';
			} else {
				echo '<img class="imgprofil" src= "'. $key->get('photo') . '" alt="' . $key->get('idAdherent'). '"/>'; 
			}
	echo '<li> idAdherent (login) : ' . $key->get('idAdherent') . '</li>';
	echo '<li> Adresse postale : ' . $key->get('adressepostaleAdherent') . '</li>';
	echo '<li> Ville : ' . $key->get('ville') . '</li>';
	echo '<li> Date d\'inscription : ' . $key->get('dateinscription') . '</li>';
	if ($key->get('estProducteur') == 1){
		echo '<li> Est producteur depuis : ' . $key->get('dateproducteur') . '</li>';
	}
	if ($key->get('description') == NULL){
			echo '<li> Le producteur n\'a pas de desciption </li>';
		} else {
			echo '<li> Description : ' . $key->get('description') . '</li>';
 
		}
	echo '<li> mailPersonne : ' . $key->get('mailPersonne') . '</li>';
	echo '</ul></div>';
}

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