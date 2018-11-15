<?php 
require_once File::build_path(array('model','ModelLivreDor.php')); // chargement du modèle

class ControllerLaVieAlAMAP
{
    protected static $object='laVieAlAMAP';

	public static function display()
	{
        $view = 'lvala';
        $pagetitle = 'La vie à l\' AMAP';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {
        $view = 'articles';
        $pagetitle = 'Articles';
        require File::build_path(array('view','view.php')); 
    }

    public static function display2nd()
    {
        $view = 'evenements';
        $pagetitle = 'Evenements';
        require File::build_path(array('view','view.php')); 
    }

    public static function display3rd()
    {
        $view = 'livredor';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php')); 
    }

    public static function Count()
    {
        $totmsg = ModelLivreDor::getNbPages();
        //var_dump($totmsg);
        $view = 'livredor';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php')); 

    }

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }


} ?>