<?php 
require_once File::build_path(array('model','ModelLivreDor.php')); // chargement du modèle
class ControllerLivreDor
{
    protected static $object='livreDor';

	public static function display()
	{
        $tabMess = ModelLivreDor::getAllMessages();
        var_dump($tabMess);

		$controller ='LivreDor';
        $view = 'livredor';
        $pagetitle = 'Livre dor';
        require File::build_path(array('view','laVieAlAMAP','view.php')); 
	}

	 public static function error()
    {
    $controller ='nousSoutenir';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}
?>