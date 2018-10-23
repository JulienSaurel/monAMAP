<?php 
class ControllerLaVieAlAMAP
{
	public static function display()
	{
		$controller ='laVieAlAMAP';
        $view = 'lvala';
        $pagetitle = 'La vie à l\' AMAP';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {
        $controller ='laVieAlAMAP';
        $view = 'articles';
        $pagetitle = 'Articles';
        require File::build_path(array('view','view.php')); 
    }

    public static function display2nd()
    {
        $controller ='laVieAlAMAP';
        $view = 'evenements';
        $pagetitle = 'Evenements';
        require File::build_path(array('view','view.php')); 
    }

    public static function display3rd()
    {
        $controller ='laVieAlAMAP';
        $view = 'livredor';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php')); 
    }

	 public static function error()
    {
    $controller ='laVieAlAMAP';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}