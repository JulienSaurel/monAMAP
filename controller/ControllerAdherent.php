<?php
require_once File::build_path(array('model','ModelAdherent.php'));

class ControllerAdherents
{   
    protected static $object='adherents';

    public static function readAll() 
    {
        $tab_adh = ModelAdherents::selectAll();
        //appel au modèle pour gerer la BD
        require File::build_path(array('view','adherent','list.php'));  
        //"redirige" vers la vue list.php qui affiche la liste des adherents
    }

	public static function read() 
    {
    	$a = $_GET['idAdherent'];
        $a = ModelAdherents::select($a);
        //appel au modèle pour gerer la BD
        if($a) 
        {
        require File::build_path(array('view','adherent','detail.php'));  
        //"redirige" vers la vue qui affiche les details d'un adherent   
        }
        else 
        {
        require File::build_path(array('view','adherent','error.php'));  
        //"redirige" vers la vue erreur.php qui affiche un msg d'erreur
        }
    }

    public static function create()
    {
        require File::build_path(array('view','adherent','create.php')); 
        //redirige vers la vue create.php (formulaire)
    }

    public static function created() 
    {
    $a = new ModelAdherents($_POST['idAdherent'],$_POST['idPersonne'],$_POST['adressepostaleAdherent'],$_POST['PW_Adherent']); //on recupere les infos du formulaires
    $a->save();// on les sauve dans la base de donnees
    self::readAll(); //on affiche la liste des personnes
    }

    public static function connect()
    {
        $view = 'connect';
        $pagetitle = 'Se connecter';
        require File::build_path(array('view','view.php'));
    }

    public static function connected()
    {
        $pw = Security::chiffrer($_POST['pw']);
         if(ModelUtilisateur::select($_POST['login'])->checkPassword($_POST['login'],$pw))
         {
            $_SESSION['login'] = $_POST['login'];
            $u = ModelUtilisateur::select($_POST['login']);
            $view = 'detail';
            $pagetitle = 'Adhérent';
            require File::build_path(array('view','view.php'));
         }
    }

    public static function deconnect()
    {
        session_unset();

        ControllerAccueil::homepage();
    }
}
?>
