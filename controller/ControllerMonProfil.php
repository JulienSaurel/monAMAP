<?php 
require_once File::build_path(array('model','ModelAdherent.php'));
require_once File::build_path(array('model','ModelPersonne.php'));
require_once File::build_path(array('lib','Security.php'));
require_once File::build_path(array('lib','Session.php'));

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


//Modifications adresses Mail
    // public static function updateAdrM(){
    //   if (isset($_SESSION['login'])) {

    //   $view = 'updateAdrM';
    //   $pagetitle = 'Modifier l\'adresse mail';
    //   require File::build_path(array('view','view.php'));
    // }
    // else {
    //   self::error();
    // }
    // }

    // public static function updatedAdrM(){
    //     if (isset($_SESSION['login'])) {
    //        //update dans la table Personne
    //         $a=$_POST['newadrM'];
    //         $primaryP='mailPersonne';
    //         $table_nameP='Personne';
    //         $b=ModelAdherent::select($_SESSION['login']);
    //         $primary_valueP=$b->get('mailPersonne');
    //         Model::update($primaryP, $primary_valueP, $table_nameP, array("mailPersonne"=>$a));

    //        //update dans la table Adherent
    //         $primaryA='idAdherent';
    //         $table_nameA='Adherent';
    //         $primary_valueA=$_SESSION['login'];
    //         Model::update($primaryA, $primary_valueA, $table_nameA, array("mailPersonne"=>$a));


    //         //redirection
    //         self::profile();
    //     } else {
    //         self::error();
    //     }
    // }

//Modifications Adresse Postale OK
    public static function updateAdrP(){
      if (isset($_SESSION['login'])) {
        $view = 'updateAdrP';
        $pagetitle = 'Modifier l\'adresse postale';
        require File::build_path(array('view','view.php'));
      }
      else {
        self::error();
      }
    }

    public static function updatedAdrP(){
      if (isset($_SESSION['login'])) {

      $a=$_POST['newadrL'];
      $b=$_POST['newVille'];
      ModelAdherent::update(array("adressePostaleAdherent"=>$a, "ville"=>$b, "idAdherent"=>$_SESSION['login']));
      self::profile();
    }
    else {
      self::error();
    }
    }

//Modifications PW ok
    public static function updatePW(){
        if (isset($_SESSION['login'])) {
            $view = 'updatePW';
            $pagetitle = 'Modifier le mot de passe';
            require File::build_path(array('view','view.php'));
        } else {
          self::error();
        }
    }

    public static function updatedPW(){
        if (isset($_SESSION['login'])) {
            $a=$_POST['oldpw'];
            $achiffre=Security::chiffrer($a);
            $b=$_POST['newpw'];
            $bchiffre=Security::chiffrer($b);
            $c=$_POST['newpw_c'];
            $mail=$_SESSION['login'];
            $mdp=ModelAdherent::select($_SESSION['login']);
            $mdpv = $mdp->get('PW_Adherent');
            //var_dump(ModelUtilisateur::getPwByMail($_SESSION['login']));
            //var_dump($mdpv);

            if ($achiffre== $mdpv){
                if($b==$c){
                  ModelAdherent::update(array("PW_Adherent"=>$bchiffre, "idAdherent"=>$_SESSION['login']));
                  self::profile();
                } 
                else {
                  echo 'les deux nouveaux mots ne correspondent pas !';
                  $view = 'updatePW';
                  $pagetitle = 'Erreur correspondance';
                  require File::build_path(array('view','view.php'));
                }
            }
            else {
                echo 'L\'ancien mot de passe est faux';
                $view = 'updatePW';
                $pagetitle = 'Erreur dans l\'ancien mot de passe';
                require File::build_path(array('view','view.php'));
            }
        } 
        else {
            self::error();
        }
  }

//Modifications description ok

  public static function updateDes(){
    $view = 'updateDes';
    $pagetitle = 'Description';
    require File::build_path(array('view','view.php')); 
  }

  public static function updatedDes(){
    if (isset($_SESSION['login'])) {
      $a=$_POST['newdesc'];
      ModelAdherent::update(array("description"=>$a, "idAdherent"=>$_SESSION['login']));
      self::profile();
    }
    else {
      self::error();
    }
  }

  //Modifications photos ok

public static function updatePhoto(){
    $view = 'updatePhoto';
    $pagetitle = 'Photo';
    require File::build_path(array('view','view.php')); 
}

public static function updatedPhoto(){
    if (isset($_SESSION['login'])) {
      $a=$_POST['photo'];
      ModelAdherent::update(array("photo"=>$a, "idAdherent"=>$_SESSION['login']));
      self::profile();
    }
    else {
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