<?php

require_once File::build_path(array('model','ModelPersonne.php'));

class ModelAdherent extends Model
{

    private $idAdherent;
    private $idPersonne;
    private $adressepostaleAdherent;
    private $ville;
    private $PW_Adherent;
    private $estProducteur;
    private $estAdministrateur;
    private $dateinscription;
    private $dateproducteur;
    private $photo;
    private $description;
    static protected $object = 'adherent';
    protected static $primary='idAdherent';

    // Getter générique
    public function get($nom_attribut)
    {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur)
    {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur

    public function __construct($idAdherent = NULL, $adressepostaleAdherent = NULL, $ville = NULL, $PW_Adherent = NULL, $idPersonne = NULL ,$estProducteur = NULL, $estAdministrateur = NULL, $dateinscription = NULL, $dateproducteur = NULL/*, $photo = NULL, $description = NULL*/)
    {
        if (!is_null($idAdherent) && !is_null($adressepostaleAdherent) && !is_null($ville) && !is_null($PW_Adherent) && !is_null($estProducteur) && !is_null($idPersonne) && !is_null($estAdministrateur) && !is_null($dateinscription)/* && !is_null($photo) && !is_null($description)*/) {

            if(strtoupper($estProducteur) == "1")
	        	$estProducteur = 1;
	        else
	        	$estProducteur = 0;
	        if (strtoupper($estAdministrateur) == "1")
	        	$estAdministrateur = 1;
	        else
	        	$estAdministrateur = 0;


            $this->idAdherent = $idAdherent;
            $this->adressepostaleAdherent = $adressepostaleAdherent;
            $this->ville = $ville;
            $this->PW_Adherent = $PW_Adherent;
	        $this->idPersonne = $idPersonne;
	        $this->estProducteur = $estProducteur;
	        $this->estAdministrateur = $estAdministrateur;
	        $this->dateinscription = $dateinscription;
	        if ($dateproducteur)
	        {
		        $this->dateproducteur = $dateproducteur;
	        }
	        /*$this->photo = $photo;
	        $this->description = $description;*/
        }
    }

    public static function select($id){
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

    }


    public function save()
    {
        $sql = "INSERT INTO Adherent (idAdherent, adressepostaleAdherent, ville, PW_Adherent, idPersonne, estProducteur, estAdministrateur, dateinscription, dateproducteur) VALUES (:idAdherent, :adressepostaleAdherent, :ville, :PW_Adherent, :idPersonne, :estProducteur, :estAdministrateur, :dateinscription, :dateproducteur)";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);


        $values = array(
            "idAdherent" => $this->idAdherent,
            "idPersonne" => $this->idPersonne,
            "adressepostaleAdherent" => $this->adressepostaleAdherent,
            "ville" => $this->ville,
            "PW_Adherent" => $this->PW_Adherent,
	        "estProducteur" => $this->estProducteur,
	        "estAdministrateur" => $this->estAdministrateur,
	        "dateinscription" => $this->dateinscription,
	        "dateproducteur" => $this->dateproducteur,
        );
        // On donne les valeurs et on exécute la requête
        $req_prep->execute($values);
    }

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