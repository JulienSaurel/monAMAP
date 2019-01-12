<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once File::build_path(array('model','ModelLivreDor.php')); // chargement du modèle
require_once File::build_path(array('model','ModelArticle.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
require_once File::build_path(array('model','Model.php')); // chargement du modèle
require_once File::build_path(array('libExternes', 'PHPMailer-master','src','MailerLoader.php'));

class ControllerLaVieAlAMAP
{
    protected static $object='laVieAlAMAP';

    //redirige vers la page "La vie à l'AMAP"
    public static function AMAPslife()
    {
        $view = 'lvala';
        $pagetitle = 'La vie à l\' AMAP';
        require File::build_path(array('view','view.php'));
    }

    //redirige vers la page "Articles"
    public static function readAllart()
    {
        $tabArticles = ModelArticle::selectAllTri();
        $view = 'articles';
        $pagetitle = 'Articles';
        require File::build_path(array('view','view.php'));
    }

    //redirige vers la page "livre d'or"
    public static function readAllmsg()
    {
        $view = 'evenements';
        $pagetitle = 'Evenements';
        require File::build_path(array('view','view.php'));
    }

    //redirige vers la page "Evenements"
    public static function readAllevents()
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
            $pseudo = $_POST['pseudo'];
            $message = $_POST['message'];
            $id = ModelLivreDor::generateId();

            $arraymsg = [
                'id_message' => $id,
                'message' => $message,
                'pseudo' => $pseudo,
                'isValid' => 0,
            ];
        }

        ModelLivreDor::save($arraymsg);

        ///////////////////////////////////////
        /// On envoie un mail aux admin //////
        /////////////////////////////////////
        $a = ModelLivreDor::select($id);
        $pseudo = $a->get('pseudo');
        $toValid = Model::countTotalToValid();
        $idurl = urlencode($id);

        $mail = new PHPMailer(TRUE);

        /* Open the try/catch block. */
        try {
            /* Set the mail sender. */
            $mail->setFrom('AMAP-Occitanie@no-reply.com', 'AMAP Occitanie');

            /* Add a recipient. */
            foreach (ModelAdherent::getMailAdmin() as $email) {
                $prenomAdmin = ModelPersonne::select($email['0'])->get('prenomPersonne');
                $nomAdmin = ModelPersonne::select($email['0'])->get('nomPersonne');
                $mail->addAddress($email['0'], "$prenomAdmin $nomAdmin");
            }

            /* Set the subject. */
            $mail->Subject = "$pseudo voudrait publier un message sur le livre d'or";

            /* Set the mail message body. */
            $mail->isHTML(TRUE);
            $mail->Body = "<html>Bonjour, pour valider le nouveau message veuillez vous connecter en tant qu'administrateur puis, veuillez cliquez <a href=\"http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedOne&controller=admin&type=livreDor&id=$idurl\">ici</a>, pour voir toutes les validations en attente veuillez cliquer <a href=\"http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validate&controller=admin\">ici</a>, il y a actuellement $toValid demandes a valider.</html>";
            $mail->AltBody = "Bonjour, pour valider le nouveau message, veuillez copier coller ce lien dans la barre de navigation http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedOne&controller=admin&type=livreDor&id=$idurl, pour voir toutes les validations en attente veuillez copier coller ce lien dans la barre de navigation http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validate&controller=admin , il y a actuellement $toValid demandes a valider.";

            /* Finally send the mail. */
            $mail->send();
        }
        catch (Exception $e)
        {
            /* PHPMailer exception. */
            echo $e->errorMessage();
        }
        catch (\Exception $e)
        {
            /* PHP exception (note the backslash to select the global namespace Exception class). */
            echo $e->getMessage();
        }

        $nombrepages = ModelLivreDor::getNbPages();

        $view = 'created';
        $pagetitle = 'Livre d\'or';
        require File::build_path(array('view','view.php'));
    }


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
            $id = ModelArticle::generateId();
            $a = ModelAdherent::select($_SESSION['login']);
            $mailPersonne = $a->get('mailPersonne');
            $titre = $_POST['titre'];
            $photo = $name ?? $_POST['photo'];
            $corps = $_POST['corps'];

            $data = [
                'idArticle' => $id,
                'titreArticle' => $titre,
                'photo' => $photo,
                'date' => $date,
                'description' => $corps,
                'mailPersonne' => $mailPersonne,
                'isValid' => 0,
            ];

            //on enregistre les données dans la bd
            ModelArticle::save($data);

            ///////////////////////////////////////
            /// On envoie un mail aux admin //////
            /////////////////////////////////////
            $a = ModelArticle::select($id);
            $email = $a->get('mailPersonne');
            $p = ModelPersonne::select($email);
            $nom = $p->get('nomPersonne');
            $prenom = $p->get('prenomPersonne');
            $toValid = Model::countTotalToValid();
            $idurl = urlencode($id);

            $mail = new PHPMailer(TRUE);

            /* Open the try/catch block. */
            try {
                /* Set the mail sender. */
                $mail->setFrom('AMAP-Occitanie@no-reply.com', 'AMAP Occitanie');

                /* Add a recipient. */

                foreach (ModelAdherent::getMailAdmin() as $email) {
                    $prenomAdmin = ModelPersonne::select($email['0'])->get('prenomPersonne');
                    $nomAdmin = ModelPersonne::select($email['0'])->get('nomPersonne');
                    $mail->addAddress($email['0'], "$prenomAdmin $nomAdmin");
                }

                /* Set the subject. */
                $mail->Subject = "$prenom $nom voudrait publier un article";

                /* Set the mail message body. */
                $mail->isHTML(TRUE);
                $mail->Body = "<html>Bonjour, pour valider le nouvel article veuillez vous connecter en tant qu'administrateur puis, veuillez cliquez <a href=\"http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedOne&controller=admin&type=article&id=$idurl\">ici</a>, pour voir toutes les validations en attente veuillez cliquer <a href=\"http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validate&controller=admin\">ici</a>, il y a actuellement $toValid demandes a valider.</html>";
                $mail->AltBody = "Bonjour, pour valider le nouvel article, veuillez copier coller ce lien dans la barre de navigation http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedOne&controller=admin&type=article&id=$idurl, pour voir toutes les validations en attente veuillez copier coller ce lien dans la barre de navigation http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validate&controller=admin , il y a actuellement $toValid demandes a valider.";

                /* Finally send the mail. */
                $mail->send();
            }
            catch (Exception $e)
            {
                /* PHPMailer exception. */
                echo $e->errorMessage();
            }
            catch (\Exception $e)
            {
                /* PHP exception (note the backslash to select the global namespace Exception class). */
                echo $e->getMessage();
            }

            //redirection vers les articles
            self::readAllart();
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