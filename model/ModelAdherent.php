<?php

require_once File::build_path(array('model','ModelPersonne.php'));

class ModelAdherent extends Model
{

    protected $idAdherent;
    protected $idPersonne;
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

    /*public static function select($id){
        error_reporting(E_ALL & ~E_NOTICE);
        $sql = "SELECT * FROM Adherent A JOIN Personne P ON P.idPersonne=A.idPersonne WHERE idAdherent=:id";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);


        $values = array(
            "id" => $id,
        );
        // On donne les valeurs et on exécute la requête
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdherent');

        $tab = $req_prep->fetchAll();
        return $tab[0];

    }*/ //???????????

    /**
     * @return null
     */
    public function checkPW($idAdherent, $mot_de_passe_chiffre)
    {

        $sql = "SELECT * FROM Adherent WHERE idAdherent=:idAdherent";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $data = array(
            "idAdherent" => $idAdherent,);

        $req_prep->execute($data);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdherent');

        $tab = $req_prep->fetchAll();


        return ($tab[0]->idAdherent==$idAdherent) && ($tab[0]->PW_Adherent==$mot_de_passe_chiffre);

    }

    public static function getMailAdmin(){
        $sql = "SELECT P.mailPersonne FROM Adherent A JOIN Personne P ON P.idPersonne=A.idPersonne WHERE A.estAdministrateur=:admin";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $data = array(
            "admin" => '1',);

        $req_prep->execute($data);

        $tabAdmin = $req_prep->fetchAll();
        //var_dump($tabAdmin[0][0]);
        return $tabAdmin;
    } 

    public function getMontantTotal(){
        $sql = "SELECT D.montantTotal FROM Adherent A JOIN Personne P ON P.idPersonne=A.idPersonne JOIN donnateur D ON P.mailPersonne=D.mailAddressDonnateur WHERE P.idPersonne=:idPersonne";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $data = array(
            "idPersonne" => $this->get('idPersonne'));

        $req_prep->execute($data);

        $tab = $req_prep->fetchAll();
        //var_dump($tab[0][0]);
        return $tab[0][0];
        //TODO reregarder plus tard s'il ny a plus de pb
    }

    
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

    
}
?>