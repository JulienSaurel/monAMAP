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
        //on verifie qu'on a toutes les infos
        if (!isset($_POST['nomPersonne']) || !isset($_POST['prenomPersonne']) || !isset($_POST['mailPersonne']))
            return self::error();
        //on recupere les infos dans des variables
        $nomPersonne = $_POST['nomPersonne'];
        $prenomPersonne = $_POST['prenomPersonne'];
        $mailPersonne = $_POST['mailPersonne'];

        //on renregistre les infos dans la bdd
        $arrayPersonne = [
            'nomPersonne' => $nomPersonne,
            'prenomPersonne' => $prenomPersonne,
            'mailPersonne' => $mailPersonne,
        ];
        ModelPersonne::save($arrayPersonne);

        //on redirige vers l'accueil
        ControllerAccueil::homepage();
    }

    public static function error()
    {
    $controller ='personne';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }

} ?>
