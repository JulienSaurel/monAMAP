<?php 
class ControllerNosContrats
{
    protected static $object='nosContrats';

	public static function display()
	{
		$controller ='nosContrats';
        $view = 'contrats';
        $pagetitle = 'Nos Contrats';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {
        $controller ='nosContrats';
        $view = 'laitier';
        $pagetitle = 'Nos Contrats Laitiers';
        require File::build_path(array('view','view.php')); 
    }

    public static function display2nd()
    {
        $controller ='nosContrats';
        $view = 'viande';
        $pagetitle = 'Nos Contrats Viande';
        require File::build_path(array('view','view.php')); 
    }

    public static function display3rd()
    {
        $controller ='nosContrats';
        $view = 'legumes';
        $pagetitle = 'Nos Contrats Légumes';
        require File::build_path(array('view','view.php')); 
    }

    public static function display4th()
    {
        $controller ='nosContrats';
        $view = 'mix';
        $pagetitle = 'Nos Contrats Mix';
        require File::build_path(array('view','view.php')); 
    }

	 public static function error()
    {
    $controller ='nosContrats';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>