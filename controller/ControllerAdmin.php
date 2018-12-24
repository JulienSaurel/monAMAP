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


	public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}
?>