<form method="post" action="?action=newprod&controller=adherent" enctype="multipart/form-data">
    <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->

    <fieldset>
        <legend>Finalisation d'inscription :</legend>
            <label for="desc">Description :</label>
        <textarea placeholder="288 caractères maximum" name="description" rows="8" cols="35"  required></textarea>
        </p>
        <input type="hidden" name="id" value=" <?php echo $id ?>">
        <p>
            <label for="fichier">Upload de votre photo :</label>
            <input type="file" name="nom-image" id="fichier" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>