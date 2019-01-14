<?php  if (isset($_SESSION['login'])) { ?>

<form method="post" action="?action=updatedAdrM&controller=monProfil">
	<fieldset>
    <legend>Modifier votre adresse mail</legend>
    <p>
      <label for="new_adrM">Nouvelle adresse mail:</label> 
      <input type="text" placeholder="Ex : leila84@yahoo.com " name="newadrM" id="newadrM" required/>
    </p>
    <p>
      <input type="submit" value="Modifier" />
    </p>
  </fieldset>
</form>
<?php }
else {?>
<li>Veuillez vous <a href="?action=connect&controller=adherent">connecter</a>, ou <a href="?action=create&controller=adherent">créer un compte.</a></li>
<?php
}?>