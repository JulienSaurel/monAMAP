<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once File::build_path(array('model','Model.php')); // chargement du modèle
require_once File::build_path(array('model','ModelArticle.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
require_once File::build_path(array('model','ModelContrat.php')); // chargement du modèle
require_once File::build_path(array('model','ModelDon.php')); // chargement du modèle
require_once File::build_path(array('model','ModelDonnateur.php')); // chargement du modèle
require_once File::build_path(array('model','ModelLivreDor.php')); // chargement du modèle
require_once File::build_path(array('model','ModelPersonne.php')); // chargement du modèle
require_once File::build_path(array('model','ModelHomepage.php'));
require_once File::build_path(array('lib','Session.php'));
require_once File::build_path(array('libExternes', 'PHPMailer-master','src','MailerLoader.php'));


class ControllerAdmin
{
    protected static $object='admin';

    /**affichage de la page de gestion
     *
     */
    public static function adminhomepage()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //On redirige vers la page d'accueil
        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $view = 'home';
        $pagetitle = 'Menu Administrateur';
        require File::build_path(array('view','adminpanel.php'));
    }

    /**
     * @return void
     *
     */
    public static function readAll($type = null)
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //on verifie qu'on a bien le type a traiter
        if (!isset($_GET['type'])) {
            if (!isset($type))
                return self::error();

        }
        $type = $type ?: $_GET['type'];

        //on recupere le tableau a traiter
        if ($type == 'adherent')
            $tab = ModelAdherent::selectAll();
        elseif ($type == 'article')
            $tab = ModelArticle::selectAllTri();
        elseif ($type == 'livreDor')
            $tab = ModelLivreDor::selectAll();
        elseif ($type == 'produit')
            $tab = ModelProduit::selectAll();
        else
            return self::error();

        if (empty($tab)) {
            $tab = [];
            if ($type == 'adherent') {
                $lenom = 'adhérents';
            } elseif ($type == 'article') {
                $lenom = 'articles';
            } elseif ($type == 'livreDor') {
                $lenom = 'messages';
            } elseif ($type == 'produit') {
                $lenom = 'produit';
            }
            $phrase = "Il n'y a pas de/d\' " . $lenom .".";
        }

        //on l'affiche
        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $view = 'list';
        $pagetitle = 'Liste des ' . $type . '.';
        return require File::build_path(['view','adminpanel.php']);
    }

    /**
     * Supprime l'objet du type donné
     * @param id de l'objet a supprimer et son type
     */
    public static function delete()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //Si on a pas toutes les données necessaires a la supression on declare une erreur
        if (!isset($_GET['type'])||!isset($_GET['id'])) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();

        }

        //on recupere tout et on traite puis on redirige vers l'accueil
        $type = $_GET['type'];
        $id = $_GET['id'];
        $Modelgen = 'Model' . ucfirst($type);
        if(!$Modelgen::delete($id)) {
            $_POST['phrase'] = File::warning('Erreur : données invalides, veuillez réessayer');
            return self::adminhomepage();
        }

        if ($type == 'adherent') {
            $lenom = 'L\'adhérent ';
        } elseif ($type == 'article') {
            $lenom = 'L\'article ';
        } elseif ($type == 'livreDor') {
            $lenom = 'Le message ';
        } elseif ($type == 'produit') {
            $lenom = 'Le produit';
        }
        $_POST['phrase'] = $lenom . $id . ' a bien été supprimé';
        return self::readAll($type);
    }

    /**
     * Redirige vers le formulaire de modification si on  a l'id en get ou de création sinon
     */
    public static function gotoupdate()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //Si on a pas toutes les données necessaires on declare une erreur
        if (!isset($_GET['type'])) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }

        //On recupere puis on traite
        $type = $_GET['type'];
        $id =  $_GET['id'] ?? null;
        $Modelgen = 'Model' . ucfirst($type);
        $o = isset($_GET['id']) ? $Modelgen::select($id) : new $Modelgen();
        if (!$o) {
            $_POST['phrase'] = File::warning('Erreur : id incorrecte, veuillez réessayer');
            return self::adminhomepage();
        }
        $restriction = $id ? 'readonly':'required';
        $idurl = $id ? urlencode($id) : null;
        $action = $id? "?action=update&controller=admin&type=$type&id=$idurl" : "?action=update&controller=admin&type=$type";
        if($type != 'produit') {
            $validate = ($id && !$o->isValid()) ? "<a href=\"?action=validatedOne&controller=admin&type=$type&id=$idurl\">Valider</a>" : "";
        }
        ///////////////////////////////////////////////////////////
        // Définitions de variables pour le formulaire adhérent //
        /////////////////////////////////////////////////////////
        if ($type == 'adherent') {
            $p = ModelPersonne::select($o->get('mailPersonne'));
            $idAdherent = $id ? htmlspecialchars($id): '';
            $nomPersonne = $id ? htmlspecialchars($p->get('nomPersonne')): '';
            $prenomPersonne = $id ? htmlspecialchars($p->get('prenomPersonne')) : '';
            $mailPersonne = $id ? htmlspecialchars($p->get('mailPersonne')) : '';
            $adressepostaleAdherent = $id ? htmlspecialchars($o->get('adressepostaleAdherent')) : '';
            $ville = $id ? htmlspecialchars($o->get('ville')) : '';
            $estAdministrateur = $id ? $o->get('estAdministrateur') : '';
            $estProducteur = $id ? $o->get('estProducteur') : '';
            $description = $id ? $o->get('description') : '';
            $photo = $id ? $o->get('photo') : '';
            $dateinscription = $id ? $o->get('dateinscription') : '';
            $dateproducteur = $id ? $o->get('dateproducteur') :'';
            $formtitle = $id ? "Modification de $prenomPersonne $nomPersonne:" : 'Inscription d\'un nouvel adhérent:';
            $submit = $id ? 'Enregistrer les modifications':'Finaliser l\'inscription';
            $inputoldphoto = $id ? "<p><label>Photo actuelle:</label><img src=\"$photo\"/></p>" : '';
            $labelupload = $id ? "Changer la photo(upload):":"Upload une photo";
            $labellinkimg = $id ? "Changer la photo(lien):":"Mettre un lien vers l'image";
            $dates = $id ? "<p><label for=\"dateinsc\">Date d'inscription:</label><input type=\"text\" value=\"$dateinscription\" name=\"dateinscription\" id=\"dateinsc\" readonly/></p>
            <p><label for=\"dateprod\">Date de producteur:</label><input type=\"text\" value=\"$dateproducteur\" name=\"dateproducteur\" id=\"dateprod\" readonly/></p>" : "";
            $inputpwd = $id ? '' : "<p><label for=\"pw1\">Mot de passe :</label><input type=\"password\" placeholder=\"8 caractères minimum\" name=\"PW_Adherent\" id=\"pw1\"  required/></p><p>
            <label for=\"pw2\">Valider le mot de passe :</label><input type=\"password\" name=\"PW_Adherent2\" id=\"pw2\" required/></p>";
        }
        ///////////////////////////////////////////////////////////
        // Définitions de variables pour le formulaire articles //
        /////////////////////////////////////////////////////////
        elseif ($type == 'article') {
            $idArticle = $id ? htmlspecialchars($id):'';
            $titreArticle = $id ? htmlspecialchars($o->get('titreArticle')):'';
            $mailPersonne = $id ? htmlspecialchars($o->get('mailPersonne')):'';
            $description = $id ? htmlspecialchars($o->get('description')):'';
            $photo = $id ? htmlspecialchars($o->get('photo')):'';
            $date = $id ? htmlspecialchars($o->get('date')):'';
            $formtitle = $id ? "Modification de l'article $titreArticle:":"Création d'un nouvel article:";
            $submit = $id ? 'Enregistrer les modifications':'Créer le nouvel article';
            $inputoldphoto = $id ? "<p><label>Photo actuelle:</label><img src=\"$photo\"/></p>" : '';
            $labelupload = $id ? "Changer la photo(upload):":"Upload une photo";
            $labellinkimg = $id ? "Changer la photo(lien):":"Mettre un lien vers l'image";
            $inputdate = $id ? "<p><label for=\"date\">Date de parution:</label><input type=\"text\" value=\"$date\" name=\"date\" id=\"date\" readonly/></p>":"";
            $inputid = $id ?"<p><label for=\"id\">Id</label> : <input type=\"text\" name=\"idArticle\" id=\"id\" value=\"$idArticle\" $restriction/></p>" :'';

        }
        ////////////////////////////////////////////////////////////////
        // Définitions de variables pour le formulaire du livre d'or //
        //////////////////////////////////////////////////////////////
        elseif ($type == 'livreDor') {
            $id_message = $id ? htmlspecialchars($id):'';
            $pseudo = $id ? htmlspecialchars($o->get('pseudo')) : '';
            $message = $id ? htmlspecialchars($o->get('message')):'';
            $formtitle = $id ? "Modification du message $id_message":"Création d'un nouveau message";
            $submit = $id ? "Enregistrer les modifications":"Créer le nouveau message";
            $inputid = $id ? "<p><label for=\"id\">Id du message:</label><input type=\"text\" value=\"$id_message\" name=\"id_message\" id=\"id\" $restriction></p>":"";


        }
        ///////////////////////////////////////////////////////////
        // Définitions de variables pour le formulaire produit  //
        /////////////////////////////////////////////////////////
        elseif ($type == 'produit') {
            $nomProduit = $id ? htmlspecialchars($id) : '';
            $description = $id ? htmlspecialchars($o->get('description')):'';
            $image = $id ? htmlspecialchars($o->get('image')):'';
            $formtitle = $id ? "Modification du produit $nomProduit":"Création d'un nouveau produit";
            $submit = $id ? "Enregistrer les modifications":"Créer le nouveau produit";
            $inputoldphoto = $id ? "<p><label>Photo actuelle:</label><img src=\"$image\"/></p>":"";
            $labelupload = $id ? "Changer la photo(upload):":"Upload une photo";
            $labellinkimg = $id ? "Changer la photo(lien):":"Mettre un lien vers l'image";

        }

        //On redirige vers l'action
        $phrase = "";
        $view = 'update';
        $pagetitle = $id ? 'Mis à jour ' . $type : "Création de $type";
        require File::build_path(array('view', 'adminpanel.php'));
    }

    /**
     * Update ou crée selon le formulaire recu
     */
    public static function update()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //Si on a pas toutes les données nécessaires on declare une erreur
        if (!isset($_GET['type']))
        {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }


        //On recupere les infos
        $type = $_GET['type'];


        //si c'est une mise a jour
        if (isset($_GET['id']))
        {
            //on recupere le type et l'id
            $id = $_GET['id'];
            $Modelgen = 'Model' . ucfirst($type);
            if(!$Modelgen::select($id)) {
                $_POST['phrase'] = File::warning("Veuillez réessayer avec une id valide!");
                return self::error();
            }
            $o = $Modelgen::select($id);


            //on crée un tableau des données en fonction du type
            if ($type == 'adherent') {

                ///////////////////////////////////////
                // Traitement de l'upload et verifs //
                /////////////////////////////////////
                if (!empty($_FILES['nom-image']) && is_uploaded_file($_FILES['nom-image']['tmp_name']))
                {
                    //on recupere le nom du fichier
                    $name = $_FILES['nom-image']['name'];
                    $pic_path = File::build_path(array('images', $name));
                    $allowed_ext = array("jpg", "jpeg", "png");

                    $realextarray = explode('.', $_FILES['nom-image']['name']);

                    //on test l'extension du fichier upload
                    if (!in_array(end($realextarray), $allowed_ext))
                        return self::error();

                    //on essaie de le déplacer et on retourne une erreur si ca plante
                    if (!move_uploaded_file($_FILES['nom-image']['tmp_name'], $pic_path))
                        return self::error();

                    $path = File::build_path(array('images', $name));

                    //on test que le fichier upload existe au bon endroit
                    if (!file_exists($path))
                        return self::error();

                    $name = "./images/" . $name;
                }

                //on recupere toutes les données du form
                $idAdherent = $id;
                $adressepostaleAdherent = $_POST['adressepostaleAdherent'] ?? $o->get('adressepostaleAdherent');
                $ville = $_POST['ville'] ?? $o->get('ville');
                $photo = $name ?? ($_POST['photo'] ?? $o->get('photo'));
                $description = $_POST['description'] ?? $o->get('description');
                $estAdministrateur = $_POST['estAdministrateur'] ?? $o->get('estAdministrateur');
                $estProducteur = $_POST['estProducteur'] ?? $o->get('estProducteur');
                $mailPersonne = $_POST['mailPersonne'] ?? $o->get('mailPersonne');
                $p = ModelPersonne::select($mailPersonne);
                $nomPersonne = $_POST['nomPersonne'] ?? $p->get('nomPersonne');
                $prenomPersonne = $_POST['prenomPersonne'] ?? $p->get('prenomPersonne');

                //on en fait des tableaux
                $array = [
                    'idAdherent' => $idAdherent,
                    'adressepostaleAdherent' => $adressepostaleAdherent,
                    'ville' => $ville,
                    'photo' => $photo,
                    'description' => $description,
                    'estAdministrateur' => $estAdministrateur,
                    'estProducteur' => $estProducteur,
                    'mailPersonne'  => $mailPersonne,
                ];

                $arrayPersonne = [
                    'mailPersonne' => $mailPersonne,
                    'nomPersonne'  => $nomPersonne,
                    'prenomPersonne' => $prenomPersonne,
                ];

                ModelPersonne::update($arrayPersonne);

            } elseif ($type == 'article') {

                ///////////////////////////////////////
                // Traitement de l'upload et verifs //
                /////////////////////////////////////
                if (!empty($_FILES['nom-image']) && is_uploaded_file($_FILES['nom-image']['tmp_name']))
                {
                    //on recupere le nom du fichier
                    $name = $_FILES['nom-image']['name'];
                    $pic_path = File::build_path(array('images', $name));
                    $allowed_ext = array("jpg", "jpeg", "png");

                    $realextarray = explode('.', $_FILES['nom-image']['name']);

                    //on test l'extension du fichier upload
                    if (!in_array(end($realextarray), $allowed_ext))
                        return self::error();

                    //on essaie de le déplacer et on retourne une erreur si ca plante
                    if (!move_uploaded_file($_FILES['nom-image']['tmp_name'], $pic_path))
                        return self::error();

                    $path = File::build_path(array('images', $name));

                    //on test que le fichier upload existe au bon endroit
                    if (!file_exists($path))
                        return self::error();

                    $name = "./images/" . $name;
                }

                $idArticle = $id;
                $titreArticle = $_POST['titreArticle'] ?? $o->get('titreArticle');
                $mailPersonne = $_POST['mailPersonne'] ?? $o->get('mailPersonne');
                $description = $_POST['description'] ?? $o->get('description');
                $photo = $name ?? ($_POST['photo'] ?? $o->get('photo'));

                $array = [
                    'idArticle' => $idArticle,
                    'titreArticle' => $titreArticle,
                    'mailPersonne' => $mailPersonne,
                    'description' => $description,
                    'photo' => $photo,
                ];

            } elseif ($type == 'livreDor') {
                $id_message = $id;
                $pseudo = $_POST['pseudo'] ?? $o->get('pseudo');
                $message = $_POST['message'] ?? $o->get('message');

                $array = [
                    'id_message' => $id_message,
                    'pseudo' => $pseudo,
                    'message' => $message,
                ];

            } elseif ($type == 'produit') {

                ///////////////////////////////////////
                // Traitement de l'upload et verifs //
                /////////////////////////////////////
                if (!empty($_FILES['nom-image']) && is_uploaded_file($_FILES['nom-image']['tmp_name']))
                {
                    //on recupere le nom du fichier
                    $name = $_FILES['nom-image']['name'];
                    $pic_path = File::build_path(array('images', $name));
                    $allowed_ext = array("jpg", "jpeg", "png");

                    $realextarray = explode('.', $_FILES['nom-image']['name']);

                    //on test l'extension du fichier upload
                    if (!in_array(end($realextarray), $allowed_ext))
                        return self::error();

                    //on essaie de le déplacer et on retourne une erreur si ca plante
                    if (!move_uploaded_file($_FILES['nom-image']['tmp_name'], $pic_path))
                        return self::error();

                    $path = File::build_path(array('images', $name));

                    //on test que le fichier upload existe au bon endroit
                    if (!file_exists($path))
                        return self::error();

                    $name = "./images/" . $name;
                }

                $nomProduit = $id;
                $description = $_POST['description'] ?? $o->get('description');
                $image = $name ?? ($_POST['image'] ?? $o->get('image'));

                $array = [
                    'nomProduit' => $nomProduit,
                    'description' => $description,
                    'image' => $image,
                ];

            }
            $o = $Modelgen::update($array);

            if ($type == 'adherent') {
                $lenom = 'L\'adhérent ';
            } elseif ($type == 'article') {
                $lenom = 'L\'article ';
            } elseif ($type = 'livreDor') {
                $lenom = 'Le message ';
            } elseif ($type = 'produit') {
                $lenom = 'Le produit';
            }
            $phrase = $lenom . $id . ' a bien été mise à jour';
            self::readAll($type);
        } else { //Création

            ///////////////////////////////////////
            // Traitement de l'upload et verifs //
            /////////////////////////////////////
            if (!empty($_FILES['nom-image']) && is_uploaded_file($_FILES['nom-image']['tmp_name']))
            {

                //on recupere le nom du fichier
                $name = $_FILES['nom-image']['name'];
                $pic_path = File::build_path(array('images', $name));
                $allowed_ext = array("jpg", "jpeg", "png");

                $realextarray = explode('.', $_FILES['nom-image']['name']);

                //on test l'extension du fichier upload
                if (!in_array(end($realextarray), $allowed_ext))
                    return self::error();

                //on essaie de le déplacer et on retourne une erreur si ca plante
                if (!move_uploaded_file($_FILES['nom-image']['tmp_name'], $pic_path))
                    return self::error();

                $path = File::build_path(array('images', $name));

                //on test que le fichier upload existe au bon endroit
                if (!file_exists($path))
                    return self::error();

                $name = "./images/" . $name;
            }

            if ($type == 'adherent') {

                //on verifie que les deux mots de passe sont renseignés
                if (!isset($_POST['PW_Adherent'])||!isset($_POST['PW_Adherent2']))
                {
                    $_POST['phrase'] = File::warning("Veuillez saisir un mot de passe");
                    return self::adminhomepage();
                }

                //on verifie qu'ils sont identiques
                if ($_POST['PW_Adherent'] != $_POST['PW_Adherent2'])
                {
                    $_POST['phrase'] = File::warning("Veuillez saisir deux mots de passe identiques");
                    return self::adminhomepage();
                }

                //on verifie qu'on a toutes les infos nécessaires
                if (!isset($_POST['idAdherent'])||!isset($_POST['nomPersonne'])||!isset($_POST['prenomPersonne'])||!isset($_POST['adressepostaleAdherent'])||!isset($_POST['ville'])||!isset($_POST['mailPersonne'])||!isset($_POST['estProducteur'])||!isset($_POST['estAdministrateur'])){
                    $_POST['phrase'] = File::warning("Il manque des données");
                    self::adminhomepage();
                }

                //on verifie que le pseudo soit disponible
                if (!ModelAdherent::checklogin($_POST['idAdherent']))
                {
                    $_POST['phrase'] = File::warning("Ce pseudo n'est pas disponible");
                    self::adminhomepage();
                }

                //on vérifie que le mail soit disponible
                if (!ModelAdherent::checkbindedmail($_POST['mailPersonne']))
                {
                    $_POST['phrase'] = File::warning("Cette adresse mail est déjà utilisée");
                    self::adminhomepage();
                }

                //on récupère les données du form
                $idAdherent = $_POST['idAdherent'];
                $mailPersonne = $_POST['mailPersonne'];
                $nomPersonne = $_POST['nomPersonne'];
                $prenomPersonne = $_POST['prenomPersonne'];
                $adressepostaleAdherent = $_POST['adressepostaleAdherent'];
                $ville = $_POST['ville'];
                $estAdministrateur = $_POST['estAdministrateur'];
                $estProducteur = $_POST['estProducteur'];
                $PW_Adherent = Security::chiffrer($_POST['PW_Adherent']);
                $photo = $name ?? ($_POST['photo'] ?? null);
                $dateinscription = date("Y-m-d H:i:s");

                //on crée le tableau de création de l'adhérent et de la personne
                $arrayAdherent = [
                    'idAdherent' => $idAdherent,
                    'mailPersonne' => $mailPersonne,
                    'adressepostaleAdherent' => $adressepostaleAdherent,
                    'ville' => $ville,
                    'estAdministrateur' => $estAdministrateur,
                    'estProducteur' => $estProducteur,
                    'PW_Adherent' => $PW_Adherent,
                    'photo' => $photo,
                    'dateinscription' => $dateinscription,
                    'dateproducteur' => $estProducteur ? $dateinscription : null,
                ];

                $arrayPersonne = [
                    'mailPersonne' => $mailPersonne,
                    'nomPersonne' => $nomPersonne,
                    'prenomPersonne' => $prenomPersonne,
                ];

                //si la personne n'existe pas on la crée, sinon on l'update puis on crée l'adherent
                ModelPersonne::checkMail($mailPersonne) ? ModelPersonne::save($arrayPersonne) : ModelPersonne::update($arrayPersonne);
                ModelAdherent::save($arrayAdherent);
                $_POST['phrase'] = "L'adhérent $idAdherent a bien été inscrit";

            } elseif ($type == 'article') {

                //on vérifie qu'on a bien reçu les données
                if(!isset($_POST['titreArticle'])||!isset($_POST['mailPersonne'])||!isset($_POST['description']))
                {
                    $_POST['phrase'] = File::warning("Manque de données");
                    self::adminhomepage();
                }

                //on vérifie qu'il y a une image
                if (!isset($name)&&!isset($_POST['photo']))
                {
                    $_POST['phrase'] = "Il faut une image pour l'article qu'elle soit enregistrée par upload ou rensignée par lien";
                    return self::adminhomepage();
                }

                //on récupére les infos
                $idArticle = ModelArticle::generateId();
                $titreArticle = $_POST['titreArticle'];
                $description = $_POST['description'];
                $mailPersonne = $_POST['mailPersonne'];
                $date = date("Y-m-d H:i:s");
                $photo = $name ?? $_POST['photo'];

                //on crée un tableau pour save
                $arrayArticle = [
                    'idArticle' => $idArticle,
                    'titreArticle' => $titreArticle,
                    'description' => $description,
                    'mailPersonne' => $mailPersonne,
                    'date' => $date,
                    'photo' => $photo,
                ];

                //on save
                ModelArticle::save($arrayArticle);
                $_POST['phrase'] = "L'article $titreArticle a bien été créé";

            } elseif ($type == 'livreDor') {
                //on vérifie qu'on a bien reçu les données
                if(!isset($_POST['pseudo'])||!isset($_POST['message']))
                {
                    $_POST['phrase'] = File::warning("Manque de données");
                    self::adminhomepage();
                }

                //on récupére les infos
                $id_message = ModelLivreDor::generateId();
                $pseudo = $_POST['pseudo'];
                $message = $_POST['message'];


                //on crée un tableau pour save
                $arrayMessage = [
                    'id_message' => $id_message,
                    'pseudo' => $pseudo,
                    'message' => $message,
                ];

                //on save
                ModelLivreDor::save($arrayMessage);
                $_POST['phrase'] = "Le message $id_message a bien été créé";

            } elseif ($type == 'produit') {

                //on vérifie qu'on a bien reçu les données
                if(!isset($_POST['nomProduit'])||!isset($_POST['description']))
                {
                    $_POST['phrase'] = File::warning("Manque de données");
                    self::adminhomepage();
                }

                //on vérifie qu'il y a une image
                if (!isset($name)&&!isset($_POST['image']))
                {
                    $_POST['phrase'] = "Il faut une image pour l'article qu'elle soit enregistrée par upload ou rensignée par lien";
                    return self::adminhomepage();
                }

                //on récupére les infos
                $nomProduit = $_POST['nomProduit'];
                $description = $_POST['description'];
                $image = $name ?? $_POST['image '];

                //on crée un tableau pour save
                $arrayProduit = [
                    'nomProduit' => $nomProduit,
                    'description' => $description,
                    'image' => $image,
                ];

                //on save
                ModelProduit::save($arrayProduit);
                $_POST['phrase'] = "Le produit $nomProduit a bien été créé";

            } else {
                $_POST['phrase'] = "Type inconnu, veuillez réessayer";
                return self::error();
            }


            return self::readAll($type);
        }
    }

    /**
     * @return mixed|void
     * redirige vers la page de validation
     */
    public static function validate()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        $tabAdherents = ModelAdherent::selectAllToValid();
        $tabArticles = ModelArticle::selectAllToValid();
        $tablivreDor = ModelLivreDor::selectAllToValid();

        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $view = 'validate';
        $pagetitle = 'Page de validation';
        return require File::build_path(['view','adminpanel.php']);
    }

    /**
     * valide un objet caractérisé par id et type
     */
    public static function validatedOne($type = null, $id = null)
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //Si on a pas toutes les données necessaires a la supression on declare une erreur
        if (isset($_GET['type'])&&isset($_GET['id'])) {
            //on recupere tout et on traite puis on redirige vers l'accueil
            $type = $_GET['type'];
            $id = $_GET['id'];
        }

        if (!isset($id)||!isset($type)) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }

        //en fonction du type on prepare un tableau pour l'update
        if ($type == 'adherent') {
            $lenom = 'L\'adhérent ';
            $array = [
                'idAdherent' => $id,
                'isValid' => true,
                'estProducteur' => true,
            ];

            $adh = ModelAdherent::select($id);
            $email = $adh->get('mailPersonne');
            $p = ModelPersonne::select($email);
            $nom = $p->get('nomPersonne');
            $prenom = $p->get('prenomPersonne');


            $mail = new PHPMailer(TRUE);

            /* Open the try/catch block. */
            try {
                /* Set the mail sender. */
                $mail->setFrom('AMAP-Occitanie@no-reply.com', 'AMAP Occitanie');

                /* Add a recipient. */
                $mail->addAddress($email, "$prenom $nom");

                /* Set the subject. */
                $mail->Subject = 'Acceptation de votre demande de devenir producteur';

                /* Set the mail message body. */
                $mail->isHTML(TRUE);
                $mail->Body = "<html>Bonjour $prenom $nom, félicitation, vous êtes désormais producteur officiel de l'amap d'O!</html>";
                $mail->AltBody = "Bonjour $prenom $nom, félicitation, vous êtes désormais producteur officiel de l'amap d'O!";

                /* Finally send the mail. */
                $mail->send();
            }
            catch (Exception $e)
            {
                /* PHPMailer exception. */
                echo $e->errorMessage();
            }
            catch (\Exception $e)
            {
                /* PHP exception (note the backslash to select the global namespace Exception class). */
                echo $e->getMessage();
            }

        } elseif ($type == 'article') {
            $lenom = 'L\'article ';
            $array = [
                'idArticle' => $id,
                'isValid' => true,
            ];
            $a = ModelArticle::select($id);
            $email = $a->get('mailPersonne');
            $p = ModelPersonne::select($email);
            $nom = $p->get('nomPersonne');
            $prenom = $p->get('prenomPersonne');
            $titre = $a->get('titreArticle');

            $mail = new PHPMailer(TRUE);

            /* Open the try/catch block. */
            try {
                /* Set the mail sender. */
                $mail->setFrom('AMAP-Occitanie@no-reply.com', 'AMAP Occitanie');

                /* Add a recipient. */
                $mail->addAddress($email, "$prenom $nom");

                /* Set the subject. */
                $mail->Subject = "Publication de votre article";

                /* Set the mail message body. */
                $mail->isHTML(TRUE);
                $mail->Body = "<html>Bonjour $prenom $nom, Votre article a bien été publié sur le site de l'amap!</html>";
                $mail->AltBody = "Bonjour $prenom $nom, félicitation, vous êtes désormais producteur officiel de l'amap d'O!";

                /* Finally send the mail. */
                $mail->send();
            }
            catch (Exception $e)
            {
                /* PHPMailer exception. */
                echo $e->errorMessage();
            }
            catch (\Exception $e)
            {
                /* PHP exception (note the backslash to select the global namespace Exception class). */
                echo $e->getMessage();
            }
        } elseif ($type == 'livreDor') {
            $lenom = 'Le message ';
            $array = [
                'id_message' => $id,
                'isValid' => true,
            ];
        } else {
            $_POST['phrase'] = File::warning("Erreur: type incorrect");
            return self::adminhomepage();
        }

        //on update
        $Modelgen = 'Model' . ucfirst($type);
        $Modelgen::update($array);
        if(!$Modelgen::select($id)) {
            $_POST['phrase'] = File::warning('Erreur : données invalides, veuillez réessayer');
            return self::adminhomepage();
        }


        $_POST['phrase'] = $lenom . $id . ' a bien été validé';
        return self::adminhomepage();
    }

    /**
     * Appel validatedOne autant de fois qu'il le faut pour tout valider
     */
    public static function validatedAll()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //Si on a pas toutes les données necessaires on declare une erreur
        if (!isset($_GET['type'])) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();

        }

        $type = $_GET['type'];
        if ($type == 'adherent') {
            $nameid = 'idAdherent';
        } elseif ($type == 'article') {
            $nameid = 'idArticle';
        } elseif ($type == 'livreDor') {
            $nameid = 'id_message';
        } else {
            $_POST['phrase'] = File::warning("Erreur: type incorrect");
            return self::adminhomepage();
        }

        $Modelgen = "Model" . ucfirst($type);
        foreach ($Modelgen::selectAllToValid() as $o)
        {
            $id = $o->get("$nameid");
            if (isset($_POST["$id"])) {
                self::validatedOne($type, $id);
            }
        }

        self::validate();
    }


    public static function gotorole()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        $tabAdminProd = ModelAdherent::selectAllAdminAndProd();
        $tabAdminNotProd = ModelAdherent::selectAllAdminNotProd();
        $tabProdNotAdmin = ModelAdherent::selectAllProdNotAdmin();
        $tabAdherentsOnly = ModelAdherent::selectAllOnlyAdh();


        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $pagetitle = 'Gestion des rôles';
        $view = 'roles';
        require File::build_path(['view','adminpanel.php']);
    }

    public static function setrole()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //var_dump($_POST);
        //On recupere en POST 8 tableaux: 2 par categories pour admin ou prod dans les 4 categories
        //on les traite 2 par 2

        //on recupere les tableaux dont on a besoin pour les màj
        $AdminAndProd = ModelAdherent::selectAllAdminAndProd();
        $AdminNotProd = ModelAdherent::selectAllAdminNotProd();
        $ProdNotAdmin = ModelAdherent::selectAllProdNotAdmin();
        $None = ModelAdherent::selectAllOnlyAdh();

        $i = 1;
        foreach ($AdminAndProd as $adh) {
            $idAdherent = $adh->get('idAdherent');
            $estProducteur = isset($_POST["AdminProdProd?$i"]) ? 1 : 0;
            $estAdministrateur = isset($_POST["AdminProdAdmin?$i"]) ? 1 : 0;

            $arrayAdminProd = [
                'idAdherent' => $idAdherent,
                'estProducteur' => $estProducteur,
                'estAdministrateur' => $estAdministrateur,
            ];
            //var_dump($arrayAdminProd);
            ModelAdherent::update($arrayAdminProd);
            $i++;
        }

        $i = 1;
        foreach ($AdminNotProd as $adh) {
            $idAdherent = $adh->get('idAdherent');
            $estProducteur = isset($_POST["AdminProd?$i"]) ? 1 : 0;
            $estAdministrateur = isset($_POST["AdminAdmin?$i"]) ? 1 : 0;

            $arrayAdmin = [
                'idAdherent' => $idAdherent,
                'estProducteur' => $estProducteur,
                'estAdministrateur' => $estAdministrateur,
            ];
            //var_dump($arrayAdmin);
            ModelAdherent::update($arrayAdmin);
            $i++;
        }

        $i = 1;
        foreach ($ProdNotAdmin as $adh) {
            $idAdherent = $adh->get('idAdherent');
            $estProducteur = isset($_POST["ProdProd?$i"]) ? 1 : 0;
            $estAdministrateur = isset($_POST["ProdAdmin?$i"]) ? 1 : 0;

            $arrayProd = [
                'idAdherent' => $idAdherent,
                'estProducteur' => $estProducteur,
                'estAdministrateur' => $estAdministrateur,
            ];
            //var_dump($arrayProd);
            ModelAdherent::update($arrayProd);
            $i++;
        }

        $i = 1;
        foreach ($None as $adh) {
            $idAdherent = $adh->get('idAdherent');
            $estProducteur = isset($_POST["NoneProd?$i"]) ? 1 : 0;
            $estAdministrateur = isset($_POST["NoneAdmin?$i"]) ? 1 : 0;

            $arrayNone = [
                'idAdherent' => $idAdherent,
                'estProducteur' => $estProducteur,
                'estAdministrateur' => $estAdministrateur,
            ];
            //var_dump($arrayNone);
            ModelAdherent::update($arrayNone);
            $i++;
        }

        return self::gotorole();
    }

    public static function gotoupdatehomepage()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        $tabIds = ModelHomepage::selectAllIds();
        $homepage = ModelHomepage::select('Accueil');
        $idHomepage = $homepage->get('idHompage');
        $pagetitlehp = $homepage->get('pagetitle');
        $welcomephrase = $homepage->get('welcomephrase');
        $descbannerphrase = $homepage->get('descbannerphrase');
        $newsnameandtext = $homepage->get('newsnameandtext');
        $namearticlelink = $homepage->get('namearticlelink');
        $firstarticledisplayed = $homepage->get('firstarticledisplayed');
        $secondarticledisplayed = $homepage->get('secondarticledisplayed');
        $firstparagraph = $homepage->get('firstparagraph');
        $maptitle = $homepage->get('maptitle');
        $firstimagetitle = $homepage->get('firstimagetitle');
        $firstimage = $homepage->get('firstimage');
        $firstimagephrase = $homepage->get('firstimagephrase');
        $secondimagetitle = $homepage->get('secondimagetitle');
        $secondimage = $homepage->get('secondimage');
        $secondimageparagraph = $homepage->get('secondimageparagraph');
        $firstparagraphlink = $homepage->get('firstparagraphlink');
        $firstimagelist = $homepage->get('firstimagelist');
        $maplink = $homepage->get('maplink');
        $banner = $homepage->get('banner');
        $tabIdsArt = ModelArticle::selectAllIds();

        $tabbanner = explode(" ", $banner);

        $list = explode(PHP_EOL , $firstimagelist);

        $tabnewsnameandtext = explode(PHP_EOL, $newsnameandtext);
        $news = $tabnewsnameandtext['0'];
        $name = $tabnewsnameandtext['2'];
        $text = $tabnewsnameandtext['3'];

        //on recupere un tableau des images presentes dans le repertoire images
        $cpt = 0;
        $tabimages = [];
        if ($dossier = opendir('./images'))
        {
            while(false !== ($fichier = readdir($dossier)))
            {
                $extension = explode('.',$fichier);
                $allowed_extensions = ['png','jpeg','jpg'];
                if (isset($extension['1']) && in_array($extension['1'], $allowed_extensions)) {
                    $tabimages["$cpt"] = $fichier;
                }
                $cpt++;
            }
            closedir($dossier);
        } else {
            $_POST['phrase'] = File::warning("Attention, vous essayez d'ouvrir un fichier inexistant");
            self::error();
        }

        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $pagetitle = 'Modification de la page d\'accueil';
        $view = 'newaccueil';
        require File::build_path(['view','adminpanel.php']);
    }

    public static function updatetitlehp()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }
        //var_dump($_POST);
        if (!isset($_POST['id'])||!in_array($_POST['id'], ModelHomepage::selectAllIds())) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }

        $id = $_POST['id'];
        $hp = ModelHomepage::select($id);
        $pagetitle = (isset($_POST['pagetitle'])&& $_POST['pagetitle']!="") ? $_POST['pagetitle'] : $hp->get('pagetitle');
        $welcomephrase = (isset($_POST['welcomephrase'])&& $_POST['welcomephrase']!="") ? $_POST['welcomephrase'] : $hp->get('welcomephrase');
        $descbannerphrase = (isset($_POST['descbannerphrase'])&& $_POST['descbannerphrase']!="") ? $_POST['descbannerphrase'] : $hp->get('descbannerphrase');
        $firstimagediapo = $_POST['firstimagediapo'] ?? null;
        $secondimagediapo = $_POST['secondimagediapo'] ?? null;
        $thirdimagediapo = $_POST['thirdimagediapo'] ?? null;
        $banner = ($firstimagediapo&&$secondimagediapo&&$thirdimagediapo) ? "images/$firstimagediapo" . " " ."images/$secondimagediapo" . " " ."images/$thirdimagediapo" . " " : $hp->get('banner');

        $arrayTitlehp = [
            'idHomepage' => $id,
            'pagetitle' => $pagetitle,
            'welcomephrase' => $welcomephrase,
            'descbannerphrase' => $descbannerphrase,
            'banner' => $banner,
        ];
        ModelHomepage::update($arrayTitlehp);

        self::gotoupdatehomepage();
    }

    public static function updatenewshp()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        //var_dump($_POST);
        if (!isset($_POST['id'])||!in_array($_POST['id'], ModelHomepage::selectAllIds())) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }

        $id = $_POST['id'];
        $hp = ModelHomepage::select($id);

        $namearticlelink = (isset($_POST['namearticlelink'])&& $_POST['namearticlelink']!="") ? $_POST['namearticlelink'] : $hp->get('namearticlelink');
        $firstarticledisplayed = (isset($_POST['firstarticledisplayed'])&& $_POST['firstarticledisplayed']!="") ? $_POST['firstarticledisplayed'] : $hp->get('firstarticledisplayed');
        $secondarticledisplayed = (isset($_POST['secondarticledisplayed'])&& $_POST['secondarticledisplayed']!="") ? $_POST['secondarticledisplayed'] : $hp->get('secondarticledisplayed');
        $maptitle = (isset($_POST['maptitle'])&& $_POST['maptitle']!="") ? $_POST['maptitle'] : $hp->get('maptitle');
        $maplink= (isset($_POST['maplink'])&& $_POST['maplink']!="") ? $_POST['maplink'] : $hp->get('maplink');

        $tabnewsnameandtext = explode(PHP_EOL, $hp->get('newsnameandtext'));
        $news = (isset($_POST['news'])&& $_POST['news']!="") ? $_POST['news'] : $tabnewsnameandtext['0'];
        $name = (isset($_POST['name'])&& $_POST['name']!="") ? $_POST['name'] : $tabnewsnameandtext['2'];
        $text = (isset($_POST['text'])&& $_POST['text']!="") ? $_POST['text'] : $tabnewsnameandtext['3'];
        $newsnameandtext = $news . PHP_EOL . PHP_EOL . $name . PHP_EOL . $text;

        $arrayArticlehp = [
            'idHomepage' => $id,
            'namearticlelink' => $namearticlelink,
            'firstarticledisplayed' => $firstarticledisplayed,
            'secondarticledisplayed' => $secondarticledisplayed,
            'maptitle' => $maptitle,
            'maplink' => $maplink,
            'newsnameandtext' => $newsnameandtext,
        ];
        //var_dump($arrayArticlehp);
        ModelHomepage::update($arrayArticlehp);

        self::gotoupdatehomepage();
    }

    public static function updatemiddlehp()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }
        //var_dump($_POST);
        if (!isset($_POST['id'])||!in_array($_POST['id'], ModelHomepage::selectAllIds())) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }
        //var_dump($_POST);
        $id = $_POST['id'];
        $hp = ModelHomepage::select($id);

        $firstparagraph = (isset($_POST['firstparagraph'])&& $_POST['firstparagraph']!="") ? $_POST['firstparagraph'] : $hp->get('firstparagraph');
        $firstparagraphlink = (isset($_POST['firstparagraphlink'])&& $_POST['firstparagraphlink']!="") ? $_POST['firstparagraphlink'] : $hp->get('firstparagraphlink');
        $firstimagetitle = (isset($_POST['firstimagetitle'])&& $_POST['firstimagetitle']!="") ? $_POST['firstimagetitle'] : $hp->get('firstimagetitle');
        $firstimage = (isset($_POST['firstimage'])&& $_POST['firstimage']!="") ? $_POST['firstimage'] : $hp->get('firstimage');
        $firstimagephrase = (isset($_POST['firstimagephrase'])&& $_POST['firstimagephrase']!="") ? $_POST['firstimagephrase'] : $hp->get('firstimagephrase');
        $firstimagelist = (isset($_POST['firstimagelist'])&& $_POST['firstimagelist']!="") ? $_POST['firstimagelist'] : $hp->get('firstimagelist');


        $arrayMiddlehp = [
            'idHomepage' => $id,
            'firstparagraph' => $firstparagraph,
            'firstparagraphlink' => $firstparagraphlink,
            'firstimagetitle' => $firstimagetitle,
            'firstimage' => $firstimage,
            'firstimagephrase' => $firstimagephrase,
            'firstimagelist' => $firstimagelist,
        ];
        //var_dump($arrayMiddlehp);

        ModelHomepage::update($arrayMiddlehp);

        return self::gotoupdatehomepage();

    }

    public static function updatebottomhp()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }
        //var_dump($_POST);
        if (!isset($_POST['id'])||!in_array($_POST['id'], ModelHomepage::selectAllIds())) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }
        //var_dump($_POST);
        $id = $_POST['id'];
        $hp = ModelHomepage::select($id);

        $secondimagetitle = (isset($_POST['secondimagetitle'])&& $_POST['secondimagetitle']!="") ? $_POST['secondimagetitle'] : $hp->get('secondimagetitle');
        $secondimage = (isset($_POST['secondimage'])&& $_POST['secondimage']!="") ? $_POST['secondimage'] : $hp->get('secondimage');
        $secondimageparagraph = (isset($_POST['secondimageparagraph'])&& $_POST['secondimageparagraph']!="") ? $_POST['secondimageparagraph'] : $hp->get('secondimageparagraph');


        $arrayBottomhp = [
            'idHomepage' => $id,
            'secondimagetitle' => $secondimagetitle,
            'secondimage' => $secondimage,
            'secondimageparagraph' => $secondimageparagraph,
        ];
        //var_dump($arrayBottomhp);

        ModelHomepage::update($arrayBottomhp);

        return self::gotoupdatehomepage();

    }





    /////////////////////////////////////////////////////////
    /////////////////////// AJAX ///////////////////////////
    ///////////////////////////////////////////////////////
    public static function getArticleImage()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        if (isset($_GET['id'])) {

            $id = (int)$_GET['id'];
            $photo = ModelArticle::select($id)->get('photo');
            echo $photo;
        }
    }

        public static function getArticleTitleByHpId()
    {
        if (Session::isAdmin() !== true) {
            return false;
        }

        if (isset($_GET['id'])&&isset($_GET['attr'])) {
            $article = ModelArticle::select(ModelHomepage::select($_GET['id'])->get($_GET['attr']));
            echo $article->get('titreArticle');
        }
    }

    public static function getArticlePhotoByHpId()
    {
        if (Session::isAdmin() !== true) {
            return false;
        }

        if (isset($_GET['id'])&&isset($_GET['attr'])) {
            $article = ModelArticle::select(ModelHomepage::select($_GET['id'])->get($_GET['attr']));
            echo $article->get('photo');
        }
    }

    public static function gethomepageatribute()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        if (isset($_GET['id'])&&isset($_GET['attr'])) {
            $hp = ModelHomepage::select($_GET['id']);
            $attrvalue = $hp->get($_GET['attr']);
            if (isset($_GET['img'])) {
                $attrvalue = explode("/",$attrvalue);
                //var_dump($attrvalue);
                $attrvalue = $attrvalue['2'];
            }
                echo $attrvalue;

        }
    }

    public static function getnewsnameortext()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        if (isset($_GET['id'])&&isset($_GET['offset'])) {
            $hp = ModelHomepage::select($_GET['id']);
            $attrvalue = $hp->get('newsnameandtext');
            $tab = explode(PHP_EOL, $attrvalue);
            echo $tab[$_GET['offset']];
        }
    }

    public static function getbanner()
    {
        //on teste si la personne connectée? est un admin
        if (Session::isAdmin() !== true) {
            return false;
        }

        if (isset($_GET['id'])&&isset($_GET['index'])){
            $hp = ModelHomepage::select($_GET['id']);
            $banner = $hp->get('banner');
            $tabbaner = explode(" ", $banner);
            if (isset($_GET['previ'])) {
                echo $tabbaner[$_GET['index']];
            } else {
                $tabimage = explode("/", $tabbaner[$_GET['index']]);
                $image = $tabimage['1'];
                echo $image;
            }
        }
    }

    /////////////////////////////////////////////////////////
    /////////////////////// AJAX ///////////////////////////
    ///////////////////////////////////////////////////////




//page d'erreur
    public static function error()
    {
        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $view = 'error';
        $pagetitle = 'Error 404';
        require File::build_path(array('view','adminpanel.php'));
    }
}
?>