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

    //affichage de la page de gestion
    public static function display()
    {
        //s'il est administrateur
        if (isset($_SESSION['administrateur'])) {
            $view = 'gestion';
            $pagetitle = 'Gestion et Administration';
            require File::build_path(array('view','view.php'));
        }
        //sinon erreur
        else {
            self::error();
        } 
    }

    //redirige vers la page d'administration des adhérents
    public static function gestadh(){
        //s'il est administrateur
        if (isset($_SESSION['administrateur'])) {
            //on sélectionne tous les adhérents dans un tableau
            $tab = ModelAdherent::selectAll();
            $view = 'gestadh';
            $pagetitle = 'Gestion des adhérents';
            require File::build_path(array('view','view.php'));
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
            require File::build_path(array('view','view.php'));
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
            require File::build_path(array('view','view.php'));
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
            require File::build_path(array('view','view.php'));
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
            require File::build_path(array('view','view.php'));
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
        require File::build_path(array('view','view.php'));
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
    }

    //page d'erreur
	public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}
?>