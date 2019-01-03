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
        if ($type == 'adherents')
            $tab = ModelAdherent::selectAll();
        elseif ($type == 'articles')
            $tab = ModelArticle::selectAllTri();
        elseif ($type == 'messages')
            $tab = ModelLivreDor::selectAll();
        elseif ($type == 'produits')
            $tab = ModelProduit::selectAll();
        else
            return self::error();
        if (empty($tab)) {
            $tab = array();
            $phrase = "Il n'y a pas de/d\' " . $type .".";
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

        if ($type == 'adherents') {
            $lenom = 'L\'adhérent ';
        } elseif ($type == 'articles') {
            $lenom = 'L\'article ';
        } elseif ($type = 'messages') {
            $lenom = 'Le message ';
        } elseif ($type = 'produits') {
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

                $idAdherent = $id;
                $adressepostaleAdherent = $_POST['adressepostaleAdherent'] ?? $o->get('adressepostaleAdherent');
                $ville = $_POST['ville'] ?? $o->get('ville');
                $photo = $_POST['photo'] ?? $o->get('photo');
                $description = $_POST['description'] ?? $o->get('description');
                $estAdministrateur = $_POST['estAdministrateur'] ?? $o->get('estAdministrateur');
                $estProducteur = $_POST['estProducteur'] ?? $o->get('estProducteur');
                $mailPersonne = $_POST['mailPersonne'] ?? $o->get('mailPersonne');
                $p = ModelPersonne::select($mailPersonne);
                $nomPersonne = $_POST['nomPersonne'] ?? $p->get('nomPersonne');
                $prenomPersonne = $_POST['prenomPersonne'] ?? $p->get('prenomPersonne');

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

                $idArticle = $id;
                $titreArticle = $_POST['titreArticle'] ?? $o->get('titreArticle');
                $mailPersonne = $_POST['mailPersonne'] ?? $o->get('mailPersonne');
                $description = $_POST['description'] ?? $o->get('description');
                $photo = $_POST['photo'] ?? $o->get('photo');

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
                $nomProduit = $id;
                $description = $_POST['description'] ?? $o->get('description');
                $image = $_POST['image'] ?? $o->get('image');

                $array = [
                    'nomProduit' => $nomProduit,
                    'description' => $description,
                    'image' => $image,
                ];

            }
            $o = $Modelgen::update($array);

            if ($type == 'adherents') {
                $lenom = 'L\'adhérent ';
            } elseif ($type == 'articles') {
                $lenom = 'L\'article ';
            } elseif ($type = 'messages') {
                $lenom = 'Le message ';
            } elseif ($type = 'produits') {
                $lenom = 'Le produit';
            }
            $phrase = $lenom . $id . ' a bien été mise à jour';
            self::adminhomepage();
        }
    }




    /* //redirige vers la page d'administration des adhérents
     public static function gestadh(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             //on sélectionne tous les adhérents dans un tableau
             $tab = ModelAdherent::selectAll();
             $view = 'gestadh';
             $pagetitle = 'Gestion des adhérents';
             require File::build_path(array('view','adminpanel.php'));
         }
         //sinon erreur
         else {
             self::error();
         }
     }

     //redirige vers la page d'administration des producteurs
     public static function gestpro(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             //on sélectionne tous les adhérents dans un tableau
             $tab = ModelAdherent::selectAll();
             $view = 'gestpro';
             $pagetitle = 'Gestion des adhérents';
             require File::build_path(array('view','adminpanel.php'));
         }
         //sinon erreur
         else {
             self::error();
         }
     }

     //redirige vers la page d'affichage de tous les administrateurs
     public static function gestadm(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             //on sélectionne tous les adhérents dans un tableau
             $tab = ModelAdherent::selectAll();
             $view = 'gestadm';
             $pagetitle = 'Gestion des adhérents';
             require File::build_path(array('view','adminpanel.php'));
         }
         //sinon erreur
         else {
             self::error();
         }
     }

     //redirige vers la page d'administration des articles
     public static function gestart(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             //on sélectionne tous les articles dans un tableau
             $tab = ModelArticle::selectAllTri();
             $view = 'gestart';
             $pagetitle = 'Gestion des articles';
             require File::build_path(array('view','adminpanel.php'));
         }
         //sinon erreur
         else {
             self::error();
         }
     }

     //redirige vers la page d'administration des commentaires
     public static function gestcom(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             //on sélectionne tous les commentaires dans un tableau
             $tab = ModelLivreDor::selectAll();
             $view = 'gestcom';
             $pagetitle = 'Gestion des commentaires';
             require File::build_path(array('view','adminpanel.php'));
         }
         //sinon erreur
         else {
             self::error();
         }
     }

     //action de suppression d'un adhérent
     public static function deleteAdh(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             $value = $_GET['idAdherent'];
             ModelAdherent::delete($value);
             self::gestadh();
         }
         //sinon erreur
         else {
             self::error();
         }
     }

     //action de suppression d'un producteur
     public static function deletePro(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             $value = $_GET['idAdherent'];
             ModelAdherent::delete($value);
             self::gestpro();
         }
         //sinon erreur
         else {
             self::error();
         }

     }

     //action de suppression d'un commentaire
     public static function deleteCom(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             $value = $_GET['id_message'];
             ModelLivreDor::delete($value);
             self::gestcom();
         }
         //sinon erreur
         else {
             self::error();
         }
     }

     //action de suppression d'un article
     public static function deleteArt(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             $value = $_GET['idArticle'];
             ModelArticle::delete($value);
             self::gestart();
         }
         //sinon erreur
         else {
             self::error();
         }
     }


     //redirige vers le formulaire de modification d'un article
     public static function updateArt(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
         $idp = ModelArticle::select($_GET['idArticle']);
         $view = 'updateArt';
         $pagetitle = 'Modifier l\'article';
         require File::build_path(array('view','adminpanel.php'));
       }
       //sinon erreur
       else {
         self::error();
       }
     }

     //action de modification d'un article
     public static function updatedArt(){
         //s'il est administrateur
         if (isset($_SESSION['administrateur'])) {
             $a=$_POST['newtitle'];
             $b=$_POST['newdesc'];
             $c=$_POST['newpic'];
             $primaryvalue=$_GET['idArticle'];
             ModelArticle::update(array("idArticle"=>$primaryvalue, "titreArticle"=>$a, "description"=>$b, "photo"=>$c, ));
             self::gestart();
         }
         //sinon erreur
         else {
           self::error();
         }
     }*/

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