<?php
require_once 'Adherents.php';
$a = new Adherents('1','1', 'Jean', 'Tube', 'azerty@mail.com',"7, rue des pandas", "1234");
$a->afficher();
?>