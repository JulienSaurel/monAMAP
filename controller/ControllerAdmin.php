<?php
require_once File::build_path(array('model','Model.php')); // chargement du modèle
require_once File::build_path(array('model','ModelArticle.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
require_once File::build_path(array('model','ModelContrat.php')); // chargement du modèle
require_once File::build_path(array('model','ModelDon.php')); // chargement du modèle
require_once File::build_path(array('model','ModelDonnateur.php')); // chargement du modèle
require_once File::build_path(array('model','ModelLivreDor.php')); // chargement du modèle
require_once File::build_path(array('model','ModelPersonne.php')); // chargement du modèle

class ControllerAdmin
{
    protected static $object='admin';

    /**affichage de la page de gestion
     *
     */
    public static function adminhomepage()
    {
        //Si la personne n'est pas connectée on declare une erreur
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }

        //Si la personne n'est pas admin on declare une erreur
        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            ControllerAccueil::homepage();
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
    public static function readAll()
    {
        //Si la personne n'est pas connectée on declare une erreur
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }

        //Si la personne n'est pas admin on declare une erreur
        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            ControllerAccueil::homepage();
        }

        //on verifie qu'on a bien le type a traiter
        if (!isset($_GET['type']))
            return self::error();
        $type = $_GET['type'];

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
        //Si la personne n'est pas connectée on declare une erreur
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            return ControllerAccueil::homepage();
        }

        //Si la personne n'est pas admin on declare une erreur
        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            return ControllerAccueil::homepage();
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
        return self::adminhomepage();
    }

    /**
     * Redirige vers le formulaire de modification si on  a l'id en get ou de création sinon
     */
    public static function gotoupdate()
    {
        //Si la personne n'est pas connectée on declare une erreur
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }

        //Si la personne n'est pas admin on declare une erreur
        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            ControllerAccueil::homepage();
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
        $restriction = $id ? 'readonly':'required';
        $idurl = $id ? urlencode($id) : null;
        $action = $id? "?action=update&controller=admin&type=$type&id=$idurl" : "?action=update&controller=admin&type=$type";

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

    public static function update()
    {
        //Si la personne n'est pas connectée on declare une erreur
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            return ControllerAccueil::homepage();
        }

        //Si la personne n'est pas admin on declare une erreur
        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            return ControllerAccueil::homepage();
        }

        //Si on a pas toutes les données nécessaires on declare une erreur
        if (!isset($_GET['type'])||!isset($_GET['id']))
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
            self::adminhomepage();
        } else { //Création
            if ($type == 'adherent') {
                if (!isset($_POST['PW_Adherent'])||!isset($_POST['PW_Adherent2']))
                {
                    $_POST['phrase'] = File::warning("Veuillez saisir un mot de passe");
                    return self::adminhomepage();
                }
                if ($_POST['PW_Adherent'] != $_POST['PW_Adherent2'])
                {
                    $_POST['phrase'] = File::warning("Veuillez saisir deux mots de passe identiques");
                    return self::adminhomepage();
                }
                if (!isset($_POST['idAdherent'])||!isset($_POST['nomPersonne'])||!isset($_POST['prenomPersonne'])||!isset($_POST['adressepostaleAdherent'])||!isset($_POST['ville'])||!isset($_POST['mailPersonne'])||!isset($_POST['estProducteur'])||!isset($_POST['estAdministrateur'])){
                    $_POST['phrase'] = File::warning("Il manque des données");
                    self::adminhomepage();
                }
                if (!ModelAdherent::checklogin($_POST['idAdherent']))
                {
                    $_POST['phrase'] = File::warning("Ce pseudo n'est pas disponible");
                    self::adminhomepage();
                }
                if (!ModelAdherent::checkbindedmail($_POST['mailPersonne']))
                {
                    $_POST['phrase'] = File::warning("Cette adresse mail est déjà utilisée");
                    self::adminhomepage();
                }

                $idAdherent = $_POST['idAdherent'];
                $mailPersonne = $_POST['mailPersonne'];
                $nomPersonne = $_POST['nomPersonne'];
                $prenomPersonne = $_POST['prenomPersonne'];
                $adressepostaleAdherent = $_POST['adressepostaleAdherent'];
                $ville = $_POST['ville'];
                $estAdministrateur = $_POST['estAdministrateur'];
                $estProducteur = $_POST['estProducteur'];
                $PW_Adherent = Security::chiffrer($_POST['PW_Adherent']);

                $arrayAdherent = [
                    'idAdherent' => $idAdherent,
                    'mailPersonne' => $mailPersonne,
                    'nomPersonne' => $nomPersonne,
                    'prenomPersonne' => $prenomPersonne,
                    'adressepostaleAdherent' => $adressepostaleAdherent,
                    'ville' => $ville,
                    'estAdministrateur' => $estAdministrateur,
                    'estProducteur' => $estProducteur,
                    'PW_Adherent' => $PW_Adherent,
                ];


            } elseif ($type == 'article') {

            } elseif ($type == 'livreDor') {

            } elseif ($type == 'produit') {

            }
        }
    }



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