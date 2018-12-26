<?php  if (isset($_SESSION['producteur'])) { ?>

<form method="post" action="?action=createdProd&controller=nosProduits">
	<fieldset>
    <legend>Ajoutez un nouveau produit</legend>
    



        <p>
            <label for="titre">Nom du produit :</label>
            <input type="text" placeholder="Recette" name="titre" id="titre" required/>
        </p>
        <p>
            <label for="image">URL (image pour le produit) :</label>
            <input type="text" placeholder="Ex : http://image.noelshack.com/..... " name="image" id="image" required/>
        </p>
        <p>
            <label for="description" class="bal">description de l'article :</label>
            <input type="text" placeholder="Ex : Cuisinez les marrons..." name="description" id="description" required/>
        </p>
        <p>
            <input type="submit" value="Ajouter" />
        </p>




  </fieldset>
</form>
<?php }

if (isset($_SESSION['login'])) { ?>
<!--ajouter else if isset login => devenez producteur pour ajoutez vos produits.-->

<li><a href="?action=display2nd&controller=monProfil">Devenez producteur maintenant pour pouvoir ajouter un article !</a></li>


<?php } else {?>

<li>Veuillez vous <a href="?action=connect&controller=adherent">connecter</a>, ou <a href="?action=create&controller=adherent">créer un compte.</a></li>
<?php
}?>