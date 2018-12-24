<?php 
require_once File::build_path(array('model','ModelAdherent.php'));
require_once File::build_path(array('model','ModelPersonne.php'));

class ControllerMonProfil
{

    protected static $object='monProfil';

    public static function profile()
    {   
        if (isset($_SESSION['login'])) {
            $a = ModelAdherent::select($_SESSION['login']);
            $p = ModelPersonne::select($a->get('mailPersonne'));
        $controller ='monProfil';
        $view = 'voirmonprofil';
        $pagetitle = 'Mon Profil';
        require File::build_path(array('view','view.php'));
        } else {
            self::error();
        }
    }

    public static function updateAdrM(){
      if (isset($_SESSION['login'])) {

      $view = 'updateAdrM';
      $pagetitle = 'Modifier l\'adresse mail';
      require File::build_path(array('view','view.php'));
    }
    else {
      self::error();
    }
    }

    public static function updatedAdrM(){
        if (isset($_SESSION['login'])) {
           //update dans la table Personne
            $a=$_POST['newadrM'];
            $primaryP='mailPersonne';
            $table_nameP='Personne';
            $b=ModelAdherent::select($_SESSION['login']);
            $primary_valueP=$b->get('mailPersonne');
            Model::update($primaryP, $primary_valueP, $table_nameP, array("mailPersonne"=>$a));

           //update dans la table Adherent
            $primaryA='idAdherent';
            $table_nameA='Adherent';
            $primary_valueA=$_SESSION['login'];
            Model::update($primaryA, $primary_valueA, $table_nameA, array("mailPersonne"=>$a));


            //redirection
            self::profile();
        } else {
            self::error();
        }
    }

    public static function display2nd()
    {
        $controller ='monProfil';
        $view = 'devenirproducteur';
        $pagetitle = 'Devenir Producteur';
        require File::build_path(array('view','view.php')); 
    }

	 public static function error()
    {
    $controller ='monProfil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>