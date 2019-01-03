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
     * Redirige vers le formulaire de modification
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
        if (!isset($_GET['type'])||!isset($_GET['id'])) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }

        //On recupere puis on traite
        $type = $_GET['type'];
        $id =  $_GET['id'];
        $Modelgen = 'Model' . ucfirst($type);
        $o = $Modelgen::select($id);

        if (!$o) {
            $_POST['phrase'] = File::warning('Erreur : données invalides, veuillez réessayer');
            self::adminhomepage();
        }
        //On redirige vers l'action
        $phrase = "";
        $view = 'update';
        $pagetitle = 'Mis à jour ' . $type;
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