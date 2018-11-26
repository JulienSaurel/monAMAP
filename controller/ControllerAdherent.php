<?php
require_once File::build_path(array('model','ModelAdherent.php'));

class ControllerAdherent
{   
    protected static $object='adherent';

    public static function readAll() 
    {
        $tab_adh = ModelAdherent::selectAll();
        //appel au modèle pour gerer la BD
        $view='list';
        $pagetitle = 'Liste des adhérents';
        require File::build_path(array('view', 'view.php'));
        //"redirige" vers la vue list.php qui affiche la liste des adherents
    }

	public static function read() 
    {
    	$a = $_GET['idAdherent'];
        $a = ModelAdherent::select($a);
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

        $view = 'create';
        $pagetitle = 'S\'inscrire';
        require File::build_path(array('view','view.php'));
    }

    public static function created() 
    {
        if (isset($_POST['PW_Adherent'])&&isset($_POST['PW_Adherent2']))
        {
            if ($_POST['PW_Adherent'] == $_POST['PW_Adherent2']) {
                if (isset($_POST['idAdherent']) && isset($_POST['idPersonne']) && isset($_POST['adressepostaleAdherent']) && isset($_POST['PW_Adherent'])) {
                    $a = new ModelAdherent($_POST['idAdherent'], $_POST['idPersonne'], $_POST['adressepostaleAdherent'], Security::chiffrer($_POST['PW_Adherent'])); //on recupere les infos du formulaires
                    $a->save();// on les sauve dans la base de donnees
                    $tab_adh = ModelAdherent::selectAll();
                    $view='list';
                    $pagetitle = 'Liste des adhérents';
                    require File::build_path(array('view', 'view.php'));
                }
            }
        }
    }


    public static function connect()
    {
        $view = 'connect';
        $pagetitle = 'Se connecter';
        require File::build_path(array('view','view.php'));
    }

    public static function connected()
    {
        if (isset($_POST['idAdherent'])&&isset($_POST['pw']))
        {
            $login = $_POST['idAdherent'];
            $pw = Security::chiffrer($_POST['pw']);
            if (ModelAdherent::select($_POST['idAdherent']))
            {
                if (ModelAdherent::select($login)->checkPW($login, $pw))
                {
                    $_SESSION['login'] = $login;
                    $a = ModelAdherent::select($login);
                    $view = 'detail';
                    $pagetitle = 'Adhérent';
                    require File::build_path(array('view', 'view.php'));
                }
            }
        }

    }

    public static function deconnect()
    {
        session_unset();

        ControllerAccueil::homepage();
    }
}
?>
