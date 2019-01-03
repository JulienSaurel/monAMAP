<?php
require_once File::build_path(array('model','Model.php')); // chargement du modèle
require_once File::build_path(array('model','ModelArticles.php')); // chargement du modèle
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
        if (!isset($_SESSION['login'])) {
            /*            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');*/
            ControllerAccueil::homepage();
        }

        if (!isset($_SESSION['administrateur'])) {
            /*            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');*/
            ControllerAccueil::homepage();
        }


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
        //on verifie qu'on a bien le type a traiter
        if (!isset($_GET['type']))
            return self::error();
        $type = $_GET['type'];

        //on recupere le tableau a traiter
        if ($type == 'adherents')
            $tab = ModelAdherent::selectAll();
        elseif ($type == 'articles')
            $tab = ModelArticles::selectAllTri();
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


    public static function delete()
    {
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            return ControllerAccueil::homepage();
        }
        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            return ControllerAccueil::homepage();
        }
        if (!isset($_GET['type'])||!isset($_GET['id'])) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();

        }

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

    public static function gotoupdate()
    {
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }

        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            ControllerAccueil::homepage();
        }

        if (!isset($_GET['type'])||!isset($_GET['id'])) {
            $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            return self::adminhomepage();
        }

        $type = $_GET['type'];
        $id =  $_GET['id'];
        $Modelgen = 'Model' . ucfirst($type);
        $o = $Modelgen::select($id);

        if (!$o) {
            $_POST['phrase'] = File::warning('Erreur : données invalides, veuillez réessayer');
            self::adminhomepage();
        }

        $phrase = "";
        $view = 'update';
        $pagetitle = 'Mis à jour ' . $type;
        require File::build_path(array('view', 'adminpanel.php'));
    }

    public static function update()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
                if (isset($_GET['type'])&&isset($_GET['id']))
                {
                    $type = htmlspecialchars($_GET['type']);
                    $id = htmlspecialchars($_GET['id']);
                    $Modelgen = 'Model' . $type;
                    if ($type == 'Client') {
                        $array = array(
                            'login' => $_POST['login'],
                            'nom' => $_POST['nom'],
                            'prenom' => $_POST['prenom'],
                            'mail' => $_POST['mail'],
                            'codepostal' => $_POST['codepostal'],
                            'ville' => $_POST['ville'],
                            'rue' => $_POST['rue'],
                            'isAdmin' => $_POST['isAdmin'],
                        );
                    } elseif ($type == 'Planetes')
                    {
                        $array = array(
                            'id' => $_POST['id'],
                            'prix' => $_POST['prix'],
                            'qteStock' => $_POST['qteStock'],
                            'image' => $_POST['img'],
                        );
                    }
                    $o = $Modelgen::update($array);
                    $tab_p = ModelPlanetes::selectAll();
                    $tab_c = ModelClient::selectAll();
                    $view = 'pageadmin';
                    $pagetitle = 'Menu admin';
                    if ($type == 'Planetes') {
                        $lenom = 'La planete ';
                    }
                    elseif ($type == 'Client')
                    {
                        $lenom = 'Le client ';
                    }
                    $phrase = $lenom . $id . ' a bien été mise à jour';
                    require File::build_path(array('view','view.php'));
                } else {
                    $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
                    self::adminhomepage();
                }

            } else {
                $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
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
             $tab = ModelArticles::selectAllTri();
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
             ModelArticles::delete($value);
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
         $idp = ModelArticles::select($_GET['idArticle']);
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
             ModelArticles::update(array("idArticle"=>$primaryvalue, "titreArticle"=>$a, "description"=>$b, "photo"=>$c, ));
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
        $view = 'error';
        $pagetitle = 'Error 404';
        require File::build_path(array('view','adminpanel.php'));
    }
}
?>