<?php  if (isset($_SESSION['login'])) { ?>

<form method="post" action="?action=updatedPhoto&controller=monProfil">
	<fieldset>
    <legend>Modifier votre photo</legend>
        <p>
            <label for="photo">URL photo :</label>
            <input type="photo" placeholder="Ex : http://image.noelshack.com/..... " name="photo" id="photo" required/>
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