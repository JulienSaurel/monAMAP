<?php  if (isset($_SESSION['login'])) { ?>

<form method="post" action="?action=updatedAdrP&controller=monProfil">
	<fieldset>
    <legend>Modifier votre adresse de livraison</legend>
    <p>
      <label for="new_adrL">Nouvelle adresse :</label> 
      <input type="text" placeholder="Ex : 3 boulevard des tuileries " name="newadrL" id="newadrL" required/>
    </p>
    <p>
      <label for="new_Ville">Nouvelle ville :</label> 
      <input type="text" placeholder="Ex : Lyon " name="newVille" id="newVille" required/>
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