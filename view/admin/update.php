<?php
if ($type == 'adherent') {
    $p = ModelPersonne::select($o->get('mailPersonne'));?>

    <form method="post" action="?action=update&controller=admin&type=adherent&id=<?php echo urlencode($id) ?>" enctype="multipart/form-data">
        <fieldset>
            <legend>Mis à jour de <?php echo htmlspecialchars($p->get('prenomPersonne')) . " " . htmlspecialchars($p->get('nomPersonne')) ?> :</legend>
            <p>
                <label for="id_id">Pseudo :</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('idAdherent')); ?>" name="idAdherent" id="id_id" readonly/>
            </p>
            <p>
                <label for="nom_id">Nom :</label>
                <input type="text" value="<?php echo htmlspecialchars($p->get('nomPersonne')); ?>" name="nomPersonne" id="nom_id" required/>
            </p>
            <p>
                <label for="prenom_id">Prenom :</label>
                <input type="text" value="<?php echo htmlspecialchars($p->get('prenomPersonne')); ?>" name="prenomPersonne" id="prenom_id" required/>
            </p>
            <p>
                <label for="mail_id">Mail :</label>
                <input type="email" value="<?php echo htmlspecialchars($p->get('mailPersonne')); ?>" name="mailPersonne" id="mail_id" readonly/>
            </p>
            <p>
                <label for="addpost">Adresse :</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('adressepostaleAdherent')); ?>" name="adressepostaleAdherent" id="addpost" required/>
            </p>
            <p>
                <label for="ville">Ville :</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('ville')); ?>" name="ville" id="ville" required/>
            </p>
            <p>
                <label for="isProd">Rendre Producteur:</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('estProducteur')); ?>" name="estProducteur" id="isProd" required/>
            </p>
            <p>
                <label for="isAdmin">Rendre Administrateur:</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('estAdministrateur')); ?>" name="estAdministrateur" id="isAdmin" required/>
            </p>
            <p>
                <label for="desc">Descritpion:</label>
                <textarea name="description" id="desc" rows="8" cols="35" required><?php echo htmlspecialchars($o->get('description')); ?></textarea>
            </p>
            <p>
                <label>Photo actuelle:</label>
                <img src="<?php echo $o->get('photo'); ?>"/>
            </p>
            <p>
                <label for="file">Changer la photo:</label>
                <input type="file" name="nom-image" id="file"/>
            </p>
            <p>
                <label for="dateinsc">Date d'inscription:</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('dateinscription')); ?>" name="dateinscription" id="dateinsc" readonly/>
            </p>
            <p>
                <label for="dateprod">Date de producteur:</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('dateproducteur')); ?>" name="dateproducteur" id="dateprod" readonly/>
            </p>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
        </fieldset>
    </form>
    <?php
} elseif ($type == 'article') { ?>
    <form method="post" action="?action=update&controller=admin&type=article&id=<?php echo urlencode($id) ?>" enctype="multipart/form-data" >

        <fieldset>
            <legend>Modifier <?php echo htmlspecialchars($o->get('titreArticle'));?> :</legend>
            <p>
                <label for="id">Id</label> :
                <input type="text" name="idArticle" id="id" value='<?php echo htmlspecialchars($o->get('idArticle')); ?>' readonly/>
            </p>
            <p>
                <label for="title">Titre:</label> :
                <input type="text" name="titreArticle" id="title" value='<?php echo htmlspecialchars($o->get('titreArticle')); ?>' required/>
            </p>
            <p>
                <label for="mail">Mail de l'auteur</label> :
                <input type="email" name="mailPersonne" id="mail" value='<?php echo htmlspecialchars($o->get('mailPersonne')); ?>' required/>
            </p>
            <p>
                <label for="img">Description</label> :
                <textarea name="description" id="desc" rows="8" cols="35" required><?php echo htmlspecialchars($o->get('description')); ?></textarea>
            </p>
            <p>
                <label>Photo actuelle:</label>
                <img src="<?php echo htmlspecialchars($o->get('photo')); ?>"/>
            </p>
            <p>
                <label for="file">Changer la photo:</label>
                <input type="file" name="nom-image" id="file"/>
            </p>
            <p>
                <label for="date">Date de parution:</label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('date')); ?>" name="date" id="date" readonly/>
            </p>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
        </fieldset>
    </form>

<?php } elseif ($type == 'livreDor') {?>
<form method="post" action="?action=update&controller=admin&type=livreDor&id=<?php echo urlencode($id)?>">
    <fieldset>
        <legend> Modifier un message du livre d'or:</legend>
        <p>
            <label for="id">Id du message:</label>
            <input type="text" value="<?php echo htmlspecialchars($o->get('id_message')); ?>" name="id_message" id="id" readonly>
        </p>
        <p>
            <label for="pseudo">Pseudo de l'auteur:</label>
            <input type="text" value="<?php echo htmlspecialchars($o->get('pseudo')); ?>" name="pseudo" id="pseudo" required>
        </p>
        <p>
            <label for="message">Message:</label>
            <input type="text" name="message" id="message" value="<?php echo htmlspecialchars($o->get('message')); ?>" required>
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>
<?php } elseif ($type == 'produit') {?>
<form method="post" action="?action=update&controller=admin&type=produit&id=<?php echo urlencode($id)?>">
    <fieldset>
        <legend> Modifier un produit:</legend>
        <p>
            <label for="id">Nom du produit:</label>
            <input type="text" value="<?php echo htmlspecialchars($o->get('nomProduit')); ?>" name="nomProduit" id="id" readonly>
        </p>
        <p>
            <label for="desc">Description</label> :
            <textarea name="description" id="desc" rows="8" cols="35" required><?php echo htmlspecialchars($o->get('description')); ?></textarea>
        </p>
        <p>
            <label>Photo actuelle:</label>
            <img src="<?php echo htmlspecialchars($o->get('image')); ?>"/>
        </p>
        <p>
            <label for="file">Changer la photo:</label>
            <input type="file" name="nom-image" id="file"/>
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>
<?php } ?>