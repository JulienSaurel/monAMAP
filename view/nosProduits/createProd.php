<?php  if (isset($_SESSION['producteur'])) { ?>

<form method="post" action="?action=createdProd&controller=nosProduits" enctype="multipart/form-data">
	<fieldset>
    <legend>Ajoutez un nouveau produit</legend>
    



        <p>
            <label for="titre">Nom du produit :</label>
            <input type="text" placeholder="Recette" name="nomProduit" id="titre" required/>
        </p>
        <p>
            <label for="file">Changer la photo(upload):</label>
            <input type="file" name="nom-image" id="file"/>
        </p>
        <p>
            <label for="link">Changer la photo(lien):</label>
            <input type="text" placeholder="./images/nom de l'image" name="image" id="link"/>
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