<?php
require_once File::build_path(array('model','ModelLivreDor.php')); // chargement du modèle
require_once File::build_path(array('model','ModelArticle.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
require_once File::build_path(array('model','Model.php')); // chargement du modèle

class ControllerLaVieAlAMAP
{
    protected static $object='laVieAlAMAP';

    //redirige vers la page "La vie à l'AMAP"
    public static function display()
    {
        $view = 'lvala';
        $pagetitle = 'La vie à l\' AMAP';
        require File::build_path(array('view','view.php'));
    }

    //redirige vers la page "Articles"
    public static function display1st()
    {
        $tabArticles = ModelArticle::selectAllTri();
        $view = 'articles';
        $pagetitle = 'Articles';
        require File::build_path(array('view','view.php'));
    }

    //redirige vers la page "Evenements"
    public static function display2nd()
    {
        $view = 'evenements';
        $pagetitle = 'Evenements';
        require File::build_path(array('view','view.php'));
    }

    //redirige vers la page "Evenements"
    public static function display3rd()
    {
        $nombrepages = ModelLivreDor::getNbPages();
        $page = 0;
        $tab = ModelLivreDor::getAllBetween($page, $page + ModelLivreDor::getnbmsgpg());
        $view = 'livredor';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php'));
    }

    public static function liremessage() {
        $nombrepages = ModelLivreDor::getNbPages();
        $page = $_GET['page'];
        $tab = ModelLivreDor::getAllBetween($page*5, ModelLivreDor::getnbmsgpg());
        $view = 'livre';
        $pagetitle = 'Livre d\'or page ' . $_GET['page'];
        require File::build_path(array('view','view.php'));
    }

    public static function created()
    {
        if (isset($_POST['pseudo']) && isset($_POST['message']))
        {
            $pseudo = htmlspecialchars($_POST['pseudo']); // On utilise mysql_real_escape_string et htmlspecialchars par mesure de sécurité
            $message = nl2br(htmlspecialchars($_POST['message'])); // pour le msg on gere aussi les retours charriots

            $arraymsg = [
                'message' => $message,
                'pseudo' => $pseudo,
                'isValid' => false,
            ];
        }

        ModelLivreDor::save($arraymsg);

        $nombrepages = ModelLivreDor::getNbPages();

        $view = 'created';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php'));
    }

    // public static function allArticles(){
    //     return ModelArticle::selectAll();
    // }


///////////************Création d'article************///////////

    //Redirige vers le formulaire de création d'article
    public static function createArt(){

        //si l'utilisateur est connecté
        if (isset($_SESSION['login'])){
            $view = 'createArt';
            $pagetitle = 'Nouvel article';
            require File::build_path(array('view','view.php'));
        }

        //sinon erreur 
        else {
            self::error();
        }
    }

    //action de création d'article
    public static function createdArt(){
        //si l'utilisateur est connecté
        if (isset($_SESSION['login']))
        {

            ///////////////////////////////////////
            // Traitement de l'upload et verifs //
            /////////////////////////////////////
            if (!empty($_FILES['nom-image']) && is_uploaded_file($_FILES['nom-image']['tmp_name']))
            {
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

                $name = "./images/" . $name;
            }

            $date = date("Y-m-d H:i:s");

            //on met toutes les données dans un tableau
            $a = ModelAdherent::select($_SESSION['login']);
            $mailPersonne = $a->get('mailPersonne');
            $titre = $_POST['titre'];
            $photo = $name ?? $_POST['photo'];
            $corps = $_POST['corps'];

            $data = [
                'titreArticle' => $titre,
                'photo' => $photo,
                'date' => $date,
                'description' => $corps,
                'mailPersonne' => $mailPersonne,
                'isValid' => false,
            ];

            //on enregistre les données dans la bd
            ModelArticle::save($data);

            //redirection vers les articles
            self::display1st();
        }
        //sinon erreur
        else {
            self::error();
        }
    }

    //page d'erreur
    public static function error()
    {
        $view = 'error';
        $pagetitle = 'Error 404';
        require File::build_path(array('view','view.php'));
    }




} ?>