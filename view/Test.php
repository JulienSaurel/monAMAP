<?php
require_once '../model/ModelAdherents.php';
// $a = new ModelAdherents('1','1', 'Jean', 'Tube', 'azerty@mail.com',"7, rue des pandas", "1234");
// $a->afficher();
$p = ModelPersonne::getPersonneById(1);
$p->afficher();
?>