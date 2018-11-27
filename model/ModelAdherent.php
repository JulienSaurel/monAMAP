<?php

require_once File::build_path(array('model','ModelPersonne.php'));

class ModelAdherent extends Model
{

    private $idAdherent;
    private $idPersonne;
    private $adressepostaleAdherent;
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

    public function __construct($idAdherent = NULL, $adressepostaleAdherent = NULL, $PW_Adherent = NULL, $idPersonne = NULL ,$estProducteur = NULL, $estAdministrateur = NULL, $dateinscription = NULL, $dateproducteur = NULL/*, $photo = NULL, $description = NULL*/)
    {
        if (!is_null($idAdherent) && !is_null($adressepostaleAdherent) && !is_null($PW_Adherent) && !is_null($estProducteur) && !is_null($idPersonne) && !is_null($estAdministrateur) && !is_null($dateinscription)/* && !is_null($photo) && !is_null($description)*/) {
	        if(strtoupper($estProducteur) == "TRUE")
	        	$estProducteur = 1;
	        else
	        	$estProducteur = 0;
	        if (strtoupper($estAdministrateur) == "TRUE")
	        	$estAdministrateur = 1;
	        else
	        	$estAdministrateur = 0;


            $this->idAdherent = $idAdherent;
            $this->adressepostaleAdherent = $adressepostaleAdherent;
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


    public function save()
    {
        $sql = "INSERT INTO Adherent (idAdherent, adressepostaleAdherent, PW_Adherent, idPersonne, estProducteur, estAdministrateur, dateinscription, dateproducteur) VALUES (:idAdherent, :adressepostaleAdherent, :PW_Adherent, :idPersonne, :estProducteur, :estAdministrateur, :dateinscription, :dateproducteur)";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);


        $values = array(
            "idAdherent" => $this->idAdherent,
            "idPersonne" => $this->idPersonne,
            "adressepostaleAdherent" => $this->adressepostaleAdherent,
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
}
?>