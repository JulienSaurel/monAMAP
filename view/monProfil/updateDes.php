<?php  if (isset($_SESSION['login'])) { ?>

<form method="post" action="?action=updatedDes&controller=monProfil">
	<fieldset>
    <legend>Modifier votre description</legend>
    <p>
      <label for="new_desc">Nouvelle description (500 caractères maximum):</label> 
      <input type="text" placeholder="Ex : 3 boulevard des tuileries " name="newdesc" id="newdesc" required/>
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