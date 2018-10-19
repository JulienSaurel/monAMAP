<?php 
class ControllerNousConnaitre
{
	public static function display1st()
	{
		$controller ='nousConnaitre';
        $view = 'connaitre';
        $pagetitle = 'Nous Connaitre';
        require File::build_path(array('view','view.php')); 
	}

	public static function display2nd()
	{
		$controller ='nousConnaitre';
        $view = 'lamap';
        $pagetitle = 'L\'amap';
        require File::build_path(array('view','view.php')); 
	}

	public static function display3rd()
	{
		$controller ='nousConnaitre';
        $view = 'nousContacter';
        $pagetitle = 'Nous Contacter';
        require File::build_path(array('view','view.php')); 
	}

	public static function display4th()
	{
		$controller ='nousConnaitre';
        $view = 'nousTrouver';
        $pagetitle = 'Nous Trouver';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $controller ='nousConnaitre';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }

	
}