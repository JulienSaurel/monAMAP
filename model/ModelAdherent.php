<?php

require_once File::build_path(array('model','ModelPersonne.php'));

class ModelAdherent extends Model
{

    protected $idAdherent;
    protected $mailPersonne;
    protected $adressepostaleAdherent;
    protected $ville;
    protected $PW_Adherent;
    protected $estProducteur;
    protected $estAdministrateur;
    protected $dateinscription;
    protected $dateproducteur;
    protected $photo;
    protected $description;
    static protected $object = 'adherent';
    protected static $primary='idAdherent';

	/**
	 * récupère la ModelPersonne correspondant à l'idAdherent
	 * @param l'idAdherent de la personne 
     * @return modelPersonne
     */
    public static function getPersonneByIdAdh($adh){
        try {
            $sql = "SELECT * FROM Personne WHERE mailPersonne = :id";

            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);


            $values = array(
                "id" => $adh,
            );
            // On donne les valeurs et on exécute la requête
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPersonne');

            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
		//var_dump($tab[0]);
        return $tab[0];

    }

    /**
     * @return null
     */
    public function checkPW($idAdherent, $mot_de_passe_chiffre)
    {
        try {

            $sql = "SELECT * FROM Adherent WHERE idAdherent=:idAdherent";

            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $data = array(
                "idAdherent" => $idAdherent,);

            $req_prep->execute($data);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdherent');

            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }

        return ($tab[0]->idAdherent==$idAdherent) && ($tab[0]->PW_Adherent==$mot_de_passe_chiffre);

    }

    public static function getMailAdmin(){
        try {
            $sql = "SELECT P.mailPersonne FROM Adherent A JOIN Personne P ON P.mailPersonne=A.mailPersonne WHERE A.estAdministrateur=:admin";

            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $data = array(
                "admin" => '1',);

            $req_prep->execute($data);

            $tabAdmin = $req_prep->fetchAll();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        //var_dump($tabAdmin[0][0]);
        return $tabAdmin;
    } 

    public function getMontantTotal(){
        try {
            $sql = "SELECT D.montantTotal FROM Adherent A JOIN Personne P ON P.mailPersonne=A.mailPersonne JOIN Donnateur D ON P.mailPersonne=D.mailAddressDonnateur WHERE P.mailPersonne=:mailPersonne";

            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $data = array(
                "mailPersonne" => $this->get('mailPersonne'));

            $req_prep->execute($data);

            $tab = $req_prep->fetchColumn();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        //var_dump($tab);
        return $tab;
        //TODO reregarder plus tard s'il ny a plus de pb
    }

    /**
	 * Crée un String contenant les adresses mail des administrateurs
	 * @param tableau des adresses mail des administrateurs 
     * @return la String des adresses mail des administrateurs
     */
    public static function chaineMail($tabAdmin){
        $i=0;

        $chaine='';
        while($i<count($tabAdmin)){
            $chaine = $tabAdmin[$i][0] . ', ' . $chaine  ;
            $i = $i + 1;
        }
        return $chaine;
    }

    public static function readAllProd(){
        $sql = "SELECT * FROM Adherent A WHERE A.estProducteur=:prod";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "prod" => '1');
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdherent');
        return $req_prep->fetchAll();

    }

    public static function checklogin($login)
    {
        try {
            $sql = "SELECT COUNT(*) FROM Adherent WHERE idAdherent=:login";
            $sql = Model::$pdo->prepare($sql);
            $array = ['idAdherent' => $login];
            $sql->execute($array);
            $res = $sql->fetchColumn();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        if ($res > 0)
            return false;
        return true;
    }

    public static function checkbindedmail($mail)
    {
        try {
            $sql = "SELECT COUNT(*) FROM Adherent WHERE mailPersonne=:mailPersonne";
            $sql = Model::$pdo->prepare($sql);
            $array = ['mailPersonne' => $mail];
            $sql->execute($array);
            $res = $sql->fetchColumn();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        if ($res > 0)
            return false;
        return true;
    }

    
}
?>