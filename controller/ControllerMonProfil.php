<?php 
class ControllerMonProfil
{

    protected static $object='monProfil';

	public static function display()
	{
		$controller ='monProfil';
        $view = 'profil';
        $pagetitle = 'Mon Profil';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {
        $controller ='monProfil';
        $view = 'voirmonprofil';
        $pagetitle = 'Mon Profil';
        require File::build_path(array('view','view.php')); 
    }

    public static function display2nd()
    {
        $controller ='monProfil';
        $view = 'devenirproducteur';
        $pagetitle = 'Devenir Producteur';
        require File::build_path(array('view','view.php')); 
    }

	 public static function error()
    {
    $controller ='monProfil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>