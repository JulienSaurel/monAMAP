<?php  if (isset($_SESSION['login'])) { ?>

<form method="post" action="?action=createdArt&controller=LaVieAlAMAP" enctype="multipart/form-data">
	<fieldset>
    <legend>Créez un nouvel article</legend>
    



        <p>
            <label for="titre">Nom de l'article :</label>
            <input type="text" placeholder="Recette" name="titre" id="titre" required/>
        </p>
        <p>
            <label for="file">Changer la photo(upload):</label>
            <input type="file" name="nom-image" id="file"/>
        </p>
        <p>
            <label for="link">Changer la photo(lien):</label>
            <input type="text" placeholder="./images/nom de l'image" name="photo" id="link"/>
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