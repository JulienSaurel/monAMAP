<?php  if (isset($_SESSION['login'])) { ?>

<form method="post" action="?action=createdArt&controller=LaVieAlAMAP">
	<fieldset>
    <legend>Créez un nouvel article</legend>
    



        <p>
            <label for="titre">Nom de l'article :</label>
            <input type="text" placeholder="Recette" name="titre" id="titre" required/>
        </p>
        <p>
            <label for="photo">URL (photo pour l'article) :</label>
            <input type="photo" placeholder="Ex : http://image.noelshack.com/..... " name="photo" id="photo" required/>
        </p>
        <p>
            <label for="corps" class="bal">Corps de l'article :</label>
      		<textarea name="corps" placeholder="cuisinez les marrons..." rows="8" id="corps" cols="35"></textarea><br />
    	</p>
        <p>
            <input type="submit" value="Ajouter" />
        </p>




  </fieldset>
</form>
<?php }
else {?>
<li>Veuillez vous <a href="?action=connect&controller=adherent">connecter</a>, ou <a href="?action=create&controller=adherent">créer un compte.</a></li>
<?php
}?>