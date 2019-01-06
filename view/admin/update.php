<?php
if ($type == 'adherent') {
    $p = ModelPersonne::select($o->get('mailPersonne'));?>

    <form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
        <fieldset>
            <legend><?php echo $formtitle ?> </legend>
            <p>
                <label for="id_id">Pseudo :</label>
                <input type="text" value="<?php echo $idAdherent; ?>" name="idAdherent" id="id_id" <?php echo $restriction;?>/>
            </p>
            <?php echo $inputpwd; ?>
            <p>
                <label for="nom_id">Nom :</label>
                <input type="text" value="<?php echo $nomPersonne; ?>" name="nomPersonne" id="nom_id" required/>
            </p>
            <p>
                <label for="prenom_id">Prenom :</label>
                <input type="text" value="<?php echo $prenomPersonne; ?>" name="prenomPersonne" id="prenom_id" required/>
            </p>
            <p>
                <label for="mail_id">Mail :</label>
                <input type="email" value="<?php echo $mailPersonne; ?>" name="mailPersonne" id="mail_id" <?php echo $restriction;?>/>
            </p>
            <p>
                <label for="addpost">Adresse :</label>
                <input type="text" value="<?php echo $adressepostaleAdherent; ?>" name="adressepostaleAdherent" id="addpost" required/>
            </p>
            <p>
                <label for="ville">Ville :</label>
                <input type="text" value="<?php echo $ville; ?>" name="ville" id="ville" required/>
            </p>
            <p>
                <label for="isProd">Rendre Producteur:</label>
                <input type="text" value="<?php echo $estProducteur; ?>" name="estProducteur" id="isProd" required/>
            </p>
            <p>
                <label for="isAdmin">Rendre Administrateur:</label>
                <input type="text" value="<?php echo $estAdministrateur; ?>" name="estAdministrateur" id="isAdmin" required/>
            </p>
            <p>
                <label for="desc">Descritpion:</label>
                <textarea name="description" id="desc" rows="8" cols="35"><?php echo htmlspecialchars($o->get('description')); ?></textarea>
            </p>
            <?php echo $inputoldphoto; ?>
            <p>
                <label for="file"><?php echo $labelupload; ?></label>
                <input type="file" name="nom-image" id="file"/>
            </p>
            <p>
                <label for="link"><?php echo $labellinkimg; ?></label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('photo')); ?>" name="photo" id="link"/>
            </p>
            <?php echo $dates; ?>
            <p>
                <input type="submit" value="<?php echo $submit; ?>"/>
            </p>
        </fieldset>
    </form>
    <?php
    echo $validate;
} elseif ($type == 'article') { ?>
    <form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" >

        <fieldset>
            <legend><?php echo $formtitle;?> :</legend>
            <?php echo $inputid; ?>
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
            <?php echo $inputoldphoto; ?>
            <p>
                <label for="file"><?php echo $labelupload;?></label>
                <input type="file" name="nom-image" id="file"/>
            </p>
            <p>
                <label for="link"><?php echo $labellinkimg;?></label>
                <input type="text" value="<?php echo htmlspecialchars($o->get('photo')); ?>" name="photo" id="link"/>
            </p>
            <?php echo $inputdate; ?>
            <p>
                <input type="submit" value="<?php echo $submit; ?>"/>
            </p>
        </fieldset>
    </form>

<?php echo $validate;
} elseif ($type == 'livreDor') {?>
<form method="post" action="<?php echo $action; ?>">
    <fieldset>
        <legend> <?php echo $formtitle; ?></legend>
        <?php echo $inputid;?>
        <p>
            <label for="pseudo">Pseudo de l'auteur:</label>
            <input type="text" value="<?php echo $pseudo; ?>" name="pseudo" id="pseudo" required>
        </p>
        <p>
            <label for="message">Message:</label>
            <input type="text" name="message" id="message" value="<?php echo $message; ?>" required>
        </p>
        <p>
            <input type="submit" value="<?php echo $submit; ?>"/>
        </p>
    </fieldset>
</form>
<?php echo $validate;
} elseif ($type == 'produit') {?>
<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
    <fieldset>
        <legend> <?php echo $formtitle;?></legend>
        <p>
            <label for="id">Nom du produit:</label>
            <input type="text" value="<?php echo $nomProduit; ?>" name="nomProduit" id="id" <?php echo $restriction; ?>>
        </p>
        <p>
            <label for="desc">Description</label> :
            <textarea name="description" id="desc" rows="8" cols="35" required><?php echo $description; ?></textarea>
        </p>
        <?php echo $inputoldphoto;?>
        <p>
            <label for="file"><?php echo $labelupload;?></label>
            <input type="file" name="nom-image" id="file"/>
        </p>
        <p>
            <label for="link"><?php echo $labellinkimg;?></label>
            <input type="text" value="<?php echo htmlspecialchars($o->get('image')); ?>" name="image" id="link"/>
        </p>
        <p>
            <input type="submit" value="<?php echo $submit?>"/>
        </p>
    </fieldset>
</form>
<?php } ?>