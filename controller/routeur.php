<?php
require_once 'ControllerPersonne.php';
require_once 'ControllerAdherent.php';


if(isset($_GET['actionP'])) { //Si l'action a été spécifiée

$actionPersonne = $_GET['actionP']; // On recupère l'action passée dans l'URL

ControllerPersonne::$actionPersonne(); // Appel de la méthode statique $action de ControllerPersonne

}

if(isset($_GET['actionA'])) {
$actionAdherent = $_GET['actionA']; 
ControllerAdherent::$actionAdherent();
}
?>

