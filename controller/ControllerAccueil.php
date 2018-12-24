<?php 
require_once File::build_path(array('model','ModelArticles.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
require_once File::build_path(array('model','Model.php')); // chargement du modèle
class ControllerAccueil
{
    protected static $object='accueil';

	public static function homepage()
	{
        $tab = ModelArticles::selectAllTri();
        $values = array(
            "key1" => $tab[0],
            "key2" => $tab[1],
        );
		$controller ='accueil';
        $view = 'accueil';
        $pagetitle = 'Accueil';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $controller ='accueil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('accueil','accueil.php'));
    }
}
?>