<?php
require_once '../model/ModelPersonne.php';

class ControllerPersonne
{
	public static function read() 
    {
    	$p = $_GET['idPersonne'];
        $p = ModelPersonne::getPersonneById($p);//appel au modèle pour gerer la BD
        if($p) 
        {
        require ('../view/personne/detail.php');  //"redirige" vers la vue
        }
        else 
        {
        require ('../view/personne/error.php');  //"redirige" vers la vue
        }
    }

    public static function create()
    {
        require ('../view/personne/create.php'); //redirige vers la vue
    }
}