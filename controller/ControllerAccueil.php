<?php 
require_once File::build_path(array('model','ModelArticle.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
require_once File::build_path(array('model','Model.php')); // chargement du modèle
class ControllerAccueil
{
    protected static $object='accueil';

	public static function homepage()
	{
        //on prend tous les articles triés DESC, de manière à avoir les plus récents en premiers 
        $tab = ModelArticle::selectAllTri();
        //on sélectionne les deux articles les plus récents
        $values = array(
            "key1" => $tab[0],
            "key2" => $tab[1],
        );
		//redirection vers la page d'accueil
        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $controller ='accueil';
        $view = 'accueil';
        $pagetitle = 'Accueil';
        require File::build_path(array('view','view.php')); 
	}

    //page d'erreur
	 public static function error()
    {
    $controller ='accueil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('accueil','accueil.php'));
    }
}
?>


