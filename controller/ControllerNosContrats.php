<?php 
class ControllerNosContrats
{
	public static function display()
	{
		$controller ='nosContrats';
        $view = 'contrats';
        $pagetitle = 'Nos Contrats';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $controller ='nosContrats';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}