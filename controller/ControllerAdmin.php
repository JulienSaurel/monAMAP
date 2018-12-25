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

    public static function display()
    {
        $view = 'gestion';
        $pagetitle = 'Gestion et Administration';
        require File::build_path(array('view','view.php')); 
    }

    public static function gestadh(){
        $tab = ModelAdherent::selectAll();
        $view = 'gestadh';
        $pagetitle = 'Gestion des adhérents';
        require File::build_path(array('view','view.php'));
    }

    public static function gestpro(){
        $tab = ModelAdherent::selectAll();
        $view = 'gestpro';
        $pagetitle = 'Gestion des adhérents';
        require File::build_path(array('view','view.php'));
    }

    public static function gestadm(){
        $tab = ModelAdherent::selectAll();
        $view = 'gestadm';
        $pagetitle = 'Gestion des adhérents';
        require File::build_path(array('view','view.php'));
    }

    public static function gestart(){
        $tab = ModelArticles::selectAllTri();
        $view = 'gestart';
        $pagetitle = 'Gestion des articles';
        require File::build_path(array('view','view.php'));
    }

    public static function gestcom(){
        $tab = ModelLivreDor::selectAll();
        $view = 'gestcom';
        $pagetitle = 'Gestion des commentaires';
        require File::build_path(array('view','view.php'));
    }

    public static function deleteAdh(){
        $value = $_GET['idAdherent'];
        ModelAdherent::delete($value);
        self::gestadh();

    }

    public static function deletePro(){
        $value = $_GET['idAdherent'];
        ModelAdherent::delete($value);
        self::gestpro();

    }

    public static function deleteArt(){
        $value = $_GET['idArticle'];
        ModelArticles::delete($value);
        self::gestart();

    }

    public static function deleteCom(){
        $value = $_GET['id_message'];
        ModelLivreDor::delete($value);
        self::gestcom();
    }

    public static function updateArt(){
        if (isset($_SESSION['administrateur'])) {
        $idp = ModelArticles::select($_GET['idArticle']);
        $view = 'updateArt';
        $pagetitle = 'Modifier l\'article';
        require File::build_path(array('view','view.php'));
      }
      else {
        self::error();
      }
    }

    public static function updatedArt(){
        if (isset($_SESSION['administrateur'])) {
            $a=$_POST['newtitle'];
            $b=$_POST['newdesc'];
            $c=$_POST['newpic'];
            $primaryvalue=$_GET['idArticle'];
            ModelArticles::update(array("idArticle"=>$primaryvalue, "titreArticle"=>$a, "description"=>$b, "photo"=>$c, ));
            self::gestart();
        }
        else {
          self::error();
        }
    }

	public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}
?>