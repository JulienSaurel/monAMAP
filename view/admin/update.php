<?php
if ($type == 'adherent') {
    $p = ModelPersonne::select($o->get('mailPersonne'));?>

    <form method="post" action="?action=update&controller=administrateur&type=Client&id=<?php echo $id ?>">
        <fieldset>
            <legend>Mis à jour d'un client :</legend>
            <p>
                <label for="id_id">Pseudo :</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('idAdherent')); ?>" name="login" id="id_id" readonly/>
            </p>
            <p>
                <label for="nom_id">Nom :</label>
                <input type="text" value="<?php echo htmlspecialchars($p->get('nomPersonne')); ?>" name="nom" id="nom_id" required/>
            </p>
            <p>
                <label for="prenom_id">Prenom :</label>
                <input type="text" value="<?php echo htmlspecialchars($p->get('prenomPersonne')); ?>" name="prenom" id="prenom_id" required/>
            </p>
            <p>
                <label for="mail_id">Mail :</label>
                <input type="email" value="<?php echo htmlspecialchars($p->get('mailPersonne')); ?>" name="mail" id="mail_id" readonly/>
            </p>
            <p>
                <label for="addpost">Adresse :</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('adressepostaleAdherent')); ?>" name="rue" id="addpost" required/>
            </p>
            <p>
                <label for="isProd">Rendre Producteur</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('estProducteur')); ?>" name="isProd" id="isProd" required/>
            </p>
            <p>
                <label for="isAdmin">Rendre Administrateur</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('estAdministrateur')); ?>" name="isAdmin" id="isAdmin" required/>
            </p>
            <p>
                <label for="desc">Descritpion</label>
                <textarea value="<?php echo htmlspecialchars($o->get('descritpion')); ?>" name="desc" id="desc" rows="8" cols="35" required></textarea>
            </p>
            <p>
                <label for="file">Changer la photo</label>
                <input type="file" name="fichier-image" id="file" required/>
            </p>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
        </fieldset>
    </form>
    <?php
} elseif ($type == 'Planetes') { ?>
    <form method="post" action="?action=update&controller=administrateur&type=Planetes&id=<?php echo htmlspecialchars($id) ?>">

        <fieldset>
            <legend>Modifier une planete :</legend>
            <p>
                <label for="id">Id</label> :
                <input type="text" name="id" id="id" value='<?php echo htmlspecialchars($o->get('id')); ?>'
                       readonly/>
            </p>
            <p>
                <label for="prix">Prix</label> :
                <input type="text" name="prix" id="prix" value='<?php echo htmlspecialchars($o->get('prix')); ?>'
                       required/>
            </p>
            <p>
                <label for="qte">Quantité en Stock</label> :
                <input type="number" name="qteStock" id="qte"
                       value='<?php echo htmlspecialchars($o->get('qteStock')); ?>' required/>
            </p>
            <p>
                <label for="img">Lien Image</label> :
                <input type="text" name="img" id="img" value='<?php echo htmlspecialchars($o->get('image')); ?>'
                       required/>
            </p>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
        </fieldset>
    </form>

<?php } ?>
