<?php
require_once '../model/ModelPersonne.php';

class ControllerPersonne
{   

    public static function readAll() 
    {
        $tab_pers = ModelPersonne::getAllPersonnes();//appel au modèle pour gerer la BD
        //var_dump($tab_v);
        require ('../view/personne/list.php');  //"redirige" vers la vue
    }

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

    public static function created() 
    {
    $p = new ModelPersonne($_POST['idPersonne'],$_POST['nomPersonne'],$_POST['prenomPersonne'],$_POST['mailPersonne']);
    $p->save();
    self::readAll();
    }

}
