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

	 public static function error()
    {
    $controller ='laVieAlAMAP';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}