<?php 
require_once File::build_path(array('model','ModelDonnateur.php')); // chargement du modèle
class ControllerNousSoutenir
{
	public static function display()
	{
		$controller ='nousSoutenir';
        $view = 'soutenir';
        $pagetitle = 'Nous Soutenir';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $controller ='nousSoutenir';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
	