<?php
require_once File::build_path(array('model','ModelAdherent.php'));
require_once File::build_path(array('model','ModelPersonne.php'));
require_once File::build_path(array('model','ModelContrat.php'));
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
            //on récupère les contrats en cours liés à l'adhérent
            $tabC = ModelContrat::getContrats($a->get('idAdherent'));
            // on récupère tous les contrats de l'adhérent
            $tabTotalC = ModelContrat::getTotalContrats($a->get('idAdherent'));
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



    public static function gotoupdate()
    {
        if (!isset($_SESSION['login']))
            return self::error();
        $login = $_SESSION['login'];
        $adh = ModelAdherent::select($login);
        $mail = $adh->get('mailPersonne');
        $p = ModelPersonne::select($mail);
        $nom = $p->get('nomPersonne');
        $prenom = $p->get('prenomPersonne');
        $adresse = $adh->get('adressepostaleAdherent');
        $description = $adh->get('description');
        $view = 'update';
        $pagetitle = 'Modification du profil';
        require File::build_path(array('view','view.php'));
    }

    /**
     * @uses met à jour les infos d'un profil
     * @return void: error() ou profile() selon si ca s'est bien passé ou pas
     */
    public static function update()
    {
        //s'il la personne n'est pas connectée elle ne peut pas modifier de profil
        if (!isset($_SESSION['login']))
            return self::error();

        //si on a pas toutes les infos -> erreur
        if (!isset($_POST['login']) || !isset($_POST['mail']) || !isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['adresse']) || !isset($_POST['description']))
            return self::error();

        //on recupere les donnes du form dans des variables
        $idAdherent = $_POST['login'];
        $mailPersonne = $_POST['mail'];
        $nomPersonne = $_POST['nom'];
        $prenomPersonne = $_POST['prenom'];
        $adressepostaleAdherent = $_POST['adresse'];
        $description = $_POST['description'];


        //on verifie que la personne modifie bien son profil
        if ($_SESSION['login'] != $_POST['login'])
            return self::error();

        //on verifie que le mail n'a pas été modifié en supprimant le readonly
        $mail = ModelAdherent::select($_POST['login'])->get('mailPersonne');
        if ($mail != $_POST['mail'])
            return self::error();

        //on vérifie que l'image est uploadée, si elle ne l'ai pas on recupere le champs photo dans la bdd
        if (empty($_FILES['nom-image']) || !is_uploaded_file($_FILES['nom-image']['tmp_name']))
        {
            $name = ModelAdherent::select($idAdherent)->get('photo');
        } else {

            //on recupere le nom du fichier
            $name = $_FILES['nom-image']['name'];
            $pic_path = File::build_path(array('images', $name));
            $allowed_ext = array("jpg", "jpeg", "png");

            $realextarray = explode('.', $_FILES['nom-image']['name']);

            //on test l'extension du fichier upload
            if (!in_array(end($realextarray), $allowed_ext))
                return self::error();

            //on essaie de le déplacer et on retourne une erreur si ca plante
            if (!move_uploaded_file($_FILES['nom-image']['tmp_name'], $pic_path))
                return self::error();

            $path = File::build_path(array('images', $name));

            //on test que le fichier upload existe au bon endroit
            if (!file_exists($path))
                return self::error();

            $name = "./images/$name";
        }

        //on cree des tableaux pour mettre la bdd a jour

        $arrayPersonne = [
            'mailPersonne' => $mailPersonne,
            'nomPersonne' => $nomPersonne,
            'prenomPersonne' => $prenomPersonne,
        ];

        $arrayAdherent = [
            'idAdherent' => $idAdherent,
            'adressepostaleAdherent' => $adressepostaleAdherent,
            'description' => $description,
            'photo' => $name,
        ];


        //on update
        ModelPersonne::update($arrayPersonne);
        ModelAdherent::update($arrayAdherent);

        //on redirige vers le profil
        return self::profile();
    }

    public static function becomeprod()
    {
        $view = 'devenirproducteur';
        $pagetitle = 'Devenir Producteur';
        require File::build_path(array('view','view.php'));
    }

    public static function error()
    {
        $view = 'error';
        $pagetitle = 'Error 404';
        require File::build_path(array('view','view.php'));
    }
} ?>