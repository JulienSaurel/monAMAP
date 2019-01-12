<?php
require_once File::build_path(array('model','ModelPersonne.php'));

class ControllerPersonne
{   
    protected static $object='personne';


    public static function create()
    {
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
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }

} ?>
