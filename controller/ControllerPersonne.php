<?php
require_once File::build_path(array('model','ModelPersonne.php'));

class ControllerPersonne
{   

    public static function readAll() 
    {
        $tab_pers = ModelPersonne::getAllPersonnes();
        //appel au modèle pour gerer la BD
        require File::build_path(array('view','personne','list.php'));  
        //"redirige" vers la vue list.php qui affiche la liste des personnes
    }

	public static function read() 
    {
    	$p = $_GET['idPersonne'];
        var_dump($p);
        $p = ModelPersonne::getPersonneById($p);
        var_dump($p);
        //appel au modèle pour gerer la BD
        if($p) 
        {
        require File::build_path(array('view','personne','detail.php'));  
        //"redirige" vers la vue qui affiche les details d'une personne
        }
        else 
        {
        require File::build_path(array('view','personne','error.php'));  
        //"redirige" vers la vue erreur.php qui affiche un msg d'erreur
        }
    }

    public static function create()
    {
        require File::build_path(array('view','personne','create.php')); 
        //redirige vers la vue create.php (formulaire)
    }

    public static function created() 
    {
    $p = new ModelPersonne($_POST['idPersonne'],$_POST['nomPersonne'],$_POST['prenomPersonne'],$_POST['mailPersonne']); //on recupere les infos du formulaires
    $p->save(); // on les sauve dans la base de donnees
    self::readAll(); //on affiche la liste des personnes
    }

}
