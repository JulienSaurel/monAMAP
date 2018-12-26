<?php 
require_once File::build_path(array('model','ModelAdherent.php'));
require_once File::build_path(array('model','ModelPersonne.php'));
require_once File::build_path(array('lib','Security.php'));
require_once File::build_path(array('lib','Session.php'));

class ControllerMonProfil
{

    protected static $object='monProfil';

//affiche la page "voir mon profil"
    public static function profile()
    {   
      //si l'utilisateur est connecté 
        if (isset($_SESSION['login'])) {
          //on récupère les informations de l'adhérent
            $a = ModelAdherent::select($_SESSION['login']);
            //on récupère les informations dans la table "Personne" lié l'adhérent
            $p = ModelPersonne::select($a->get('mailPersonne'));
        $controller ='monProfil';
        $view = 'voirmonprofil';
        $pagetitle = 'Mon Profil';
        require File::build_path(array('view','view.php'));
        } 
      //sinon erreur
        else {
            self::error();
        }
    }

//redirige vers la page de modifications Adresse Postale
    public static function updateAdrP(){
      //si l'utilisateur est connecté 
      if (isset($_SESSION['login'])) {
        $view = 'updateAdrP';
        $pagetitle = 'Modifier l\'adresse postale';
        require File::build_path(array('view','view.php'));
      }
      //sinon erreur
      else {
        self::error();
      }
    }

//action de modification Adresse Postale
    public static function updatedAdrP(){
      //si l'utilisateur est connecté 
      if (isset($_SESSION['login'])) {

      $a=$_POST['newadrL'];
      $b=$_POST['newVille'];
      ModelAdherent::update(array("adressePostaleAdherent"=>$a, "ville"=>$b, "idAdherent"=>$_SESSION['login']));
      self::profile();
      }
      //sinon erreur
      else {
        self::error();
      }
    }

//redirige vers la page de modifications PW
    public static function updatePW(){
      //si l'utilisateur est connecté 
      if (isset($_SESSION['login'])) {
          $view = 'updatePW';
          $pagetitle = 'Modifier le mot de passe';
          require File::build_path(array('view','view.php'));
        } 
      //sinon erreur
      else {
        self::error();
      }
    }

//action de modification PW
    public static function updatedPW(){
      //si l'utilisateur est connecté 
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
      //sinon erreur
      else {
          self::error();
      }
  }

//redirige vers la page de modifications Description
  public static function updateDes(){
    $view = 'updateDes';
    $pagetitle = 'Description';
    require File::build_path(array('view','view.php')); 
  }

//action de modification Description
  public static function updatedDes(){
    //si l'utilisateur est connecté 
    if (isset($_SESSION['login'])) {
      $a=$_POST['newdesc'];
      ModelAdherent::update(array("description"=>$a, "idAdherent"=>$_SESSION['login']));
      self::profile();
    }
    //sinon erreur    
    else {
      self::error();
    }
  }

//redirige vers la page de modifications Photo
public static function updatePhoto(){
    //si l'utilisateur est connecté 
    if (isset($_SESSION['login'])) {
      $view = 'updatePhoto';
      $pagetitle = 'Photo';
      require File::build_path(array('view','view.php'));
    }
    //sinon erreur
    else {
      self::error();
    } 
}

//action de modification Photo
public static function updatedPhoto(){
      //si l'utilisateur est connecté 
      if (isset($_SESSION['login'])) {
        $a=$_POST['photo'];
        ModelAdherent::update(array("photo"=>$a, "idAdherent"=>$_SESSION['login']));
        self::profile();
      }
      //sinon erreur
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