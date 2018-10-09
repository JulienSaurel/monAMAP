<?php
require_once 'ControllerPersonne.php';
// On recupère l'action passée dans l'URL
$actionPersonne = $_GET['action'];
// Appel de la méthode statique $action de ControllerPersonne
ControllerPersonne::$actionPersonne(); 
?>

