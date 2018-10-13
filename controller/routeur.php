<?php
require_once File::build_path(array('controller','ControllerPersonne.php'));
require_once File::build_path(array('controller','ControllerAdherent.php'));

//Personne
if(isset($_GET['actionP'])) { //Si l'action a été spécifiée

$actionPersonne = $_GET['actionP']; // On recupère l'action passée dans l'URL

ControllerPersonne::$actionPersonne(); // Appel de la méthode statique $action de ControllerPersonne
}


//Adherent
if(isset($_GET['actionA'])) { //Si l'action a été spécifiée

$actionAdherent = $_GET['actionA']; // On recupère l'action passée dans l'URL

ControllerAdherent::$actionAdherent(); // Appel de la méthode statique $action de ControllerAdherent
}
?>

