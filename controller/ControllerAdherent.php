<?php
require_once '../model/ModelAdherent.php';

class ControllerAdherent
{   

    public static function readAll() 
    {
        $tab_adh = ModelAdherent::getAllAdherents();//appel au modèle pour gerer la BD
        //var_dump($tab_v);
        require ('../view/Adherent/list.php');  //"redirige" vers la vue
    }

	public static function read() 
    {
    	$a = $_GET['idAdherent'];
        $a = ModelAdherent::getAdherentById($a);//appel au modèle pour gerer la BD
        if($a) 
        {
        require ('../view/Adherent/detail.php');  //"redirige" vers la vue
        }
        else 
        {
        require ('../view/Adherent/error.php');  //"redirige" vers la vue
        }
    }

    public static function create()
    {
        require ('../view/Adherent/create.php'); //redirige vers la vue
    }

    public static function created() 
    {
    $a = new ModelAdherent($_POST['idAdherent'],$_POST['idPersonne'],$_POST['adressepostaleAdherent'],$_POST['PW_Adherent']); //on recupere les infos du formulaires
    $a->save();// on les sauve dans la base de donnees
    self::readAll(); //on affiche la liste des personnes
    }

}
