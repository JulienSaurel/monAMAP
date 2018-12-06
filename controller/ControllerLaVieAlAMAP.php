<?php 
require_once File::build_path(array('model','ModelLivreDor.php')); // chargement du modèle
require_once File::build_path(array('model','ModelArticles.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle

class ControllerLaVieAlAMAP
{
    protected static $object='laVieAlAMAP';

	public static function display()
	{
        $view = 'lvala';
        $pagetitle = 'La vie à l\' AMAP';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {
        $tabArticles = ModelArticles::selectAll();
        

        $view = 'articles';
        $pagetitle = 'Articles';
        require File::build_path(array('view','view.php')); 
    }

    public static function display2nd()
    {
        $view = 'evenements';
        $pagetitle = 'Evenements';
        require File::build_path(array('view','view.php')); 
    }

    public static function display3rd()
    {   
        $nombrepages = ModelLivreDor::getNbPages();
        $page = 0;
        $tab = ModelLivreDor::getAllBetween($page, $page + ModelLivreDor::getnbmsgpg());
        $view = 'livredor';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php')); 
    }

    public static function liremessage() {
        $nombrepages = ModelLivreDor::getNbPages(); 
        $page = $_GET['page'];
        $tab = ModelLivreDor::getAllBetween($page, $page + ModelLivreDor::getnbmsgpg());
        $view = 'livre';
        $pagetitle = 'Livre d\'or page ' . $_GET['page'];
        require File::build_path(array('view','view.php'));
    }

    public static function created()
    {
        if (isset($_POST['pseudo']) AND isset($_POST['message']))
        {
            $pseudo = htmlspecialchars($_POST['pseudo']); // On utilise mysql_real_escape_string et htmlspecialchars par mesure de sécurité
            $message = nl2br(htmlspecialchars($_POST['message'])); // pour le msg on gere aussi les retours charriots
        }
        $m = new ModelLivreDor($pseudo, $message);
        $m->save();
        $nombrepages = ModelLivreDor::getNbPages();
        $view = 'created';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php'));
    }

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }

    public static function allArticles(){
        return ModelArticles::selectAll();
    }




} ?>