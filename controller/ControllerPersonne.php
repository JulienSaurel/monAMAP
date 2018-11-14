<?php
require_once File::build_path(array('model','ModelPersonne.php'));

class ControllerPersonne
{   
    protected static $object='personne';

    public static function readAll() 
    {
        $tab_pers = ModelPersonne::selectAll();
        //appel au modèle pour gerer la BD
        $view = 'list';
        $pagetitle = 'Liste des personnes';
        require File::build_path(array('view','view.php'));  
        //"redirige" vers la vue list.php qui affiche la liste des personnes
    }

	public static function read() 
    {
    	$p = $_GET['idPersonne'];

        $p = ModelPersonne::select($p);
        //appel au modèle pour gerer la BD
        
        if($p) 
        {
        $view = 'detail';
        $pagetitle = 'Personnes';
        require File::build_path(array('view','view.php'));  
        //"redirige" vers la vue qui affiche les details d'une personne
        }
        else 
        {
        $view = 'error';
        $pagetitle = 'Error 404';
        require File::build_path(array('view','view.php'));  
        //"redirige" vers la vue erreur.php qui affiche un msg d'erreur
        }
    }

    public static function create()
    {
    $controller ='personne';
    $view = 'create';
    $pagetitle = 'Inscription Personne';
    require File::build_path(array('view','view.php')); 
        //redirige vers la vue create.php (formulaire)
    }

    public static function created() 
    {
    $p = new ModelPersonne($_POST['idPersonne'],$_POST['nomPersonne'],$_POST['prenomPersonne'],$_POST['mailPersonne']); //on recupere les infos du formulaires
    $p->save(); // on les sauve dans la base de donnees
    $controller ='personne';
    $view = 'created';
    $pagetitle = 'Liste des personnes';
    require File::build_path(array('view','view.php')); 
        //redirige vers la vue created.php 
    self::readAll(); //on affiche la liste des personnes
    }

    public static function error()
    {
    $controller ='personne';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }

} ?>
