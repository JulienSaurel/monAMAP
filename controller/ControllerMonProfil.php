<?php 
class ControllerMonProfil
{
	public static function display()
	{
		$controller ='monProfil';
        $view = 'profil';
        $pagetitle = 'Mon Profil';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $controller ='monProfil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}