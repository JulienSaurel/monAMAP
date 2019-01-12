    <form method="post" action="?action=update&controller=monProfil" enctype="multipart/form-data">
        <fieldset>
            <legend>Modifier votre profil</legend>
            <p>
                <label for="login">Pseudo:</label>
                <input type="text" value="<?php echo htmlspecialchars($login); ?>" name="login" id="login" readonly/>
            </p>
            <p>
                <label for="nom">Nom:</label>
                <input type="text" value="<?php echo htmlspecialchars($nom); ?>" name="nom" id="nom" required/>
            </p>
            <p>
                <label for="prenom">Prénom:</label>
                <input type="text" value="<?php echo htmlspecialchars($prenom); ?>" name="prenom" id="prenom" required/>
            </p>
            <p>
                <label for="mail">Adresse mail:</label>
                <input type="text" value="<?php echo htmlspecialchars($mail); ?>" name="mail" id="mail" readonly/>
            </p>
            <p>
                <label for="adresse">Adresse postale:</label>
                <input type="text" value="<?php echo htmlspecialchars($adresse); ?>" name="adresse" id="adresse" required/>
            </p>
            <p>
                <label for="description">Description:</label>
                <input type="text" value="<?php echo htmlspecialchars($description); ?>" name="description" id="description"/>
            </p>
            <p>
                <label for="fichier">Photo(jpg, png ou jpeg):</label>
                <input type="file" name="nom-image" id="fichier"/>
            </p>
            <p>
                <input type="submit" value="Modifier" />
            </p>
        </fieldset>
    </form>
