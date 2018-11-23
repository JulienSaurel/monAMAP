<?php 
class ControllerAccueil
{
    protected static $object='accueil';

	public static function homepage()
	{
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