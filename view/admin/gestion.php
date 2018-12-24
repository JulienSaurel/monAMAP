<?php  if (isset($_SESSION['administrateur'])) { ?>

<h1>Gestion</h1>

<!--Liste de ce que peut gérer l'administrateur du site-->
<ul>
<li><a href="?action=gestadh&controller=admin">Gestion des Adhérents</a></li><!--revoi vers un lien de gestion-->
<li><a href="?action=gestpro&controller=admin">Gestion des Producteurs</a></li><!--revoi vers un lien de gestion-->
<li><a href="?action=gestadm&controller=admin">Gestion des Administrateurs</a></li><!--revoi vers un lien de gestion-->
<li>Gestion des Articles</li><!--revoi vers un lien de gestion-->
</ul>

<?php }

else {

?>

<li>Veuillez vous <a href="?action=connect&controller=adherent">connecter</a>, ou <a href="?action=create&controller=adherent">créer un compte.</a></li>

<?php

	}

?>
