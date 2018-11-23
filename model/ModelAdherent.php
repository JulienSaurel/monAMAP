<?php

require_once File::build_path(array('model','ModelPersonne.php'));

class ModelAdherents extends Model 
{

    private $idAdherent;
    private $idPersonne;
    private $adressepostaleAdherent;
    private $PW_Adherent;
    static protected $object = 'adherents';
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
    public function __construct($idAdherent = NULL, $idPersonne = NULL, $nomPersonne = NULL, $prenomPersonne = NULL, $mailPersonne = NULL, $adressepostaleAdherent = NULL, $PW_Adherent = NULL) 
    {
        if (!is_null($idAdherent) && !is_null($idPersonne) && !is_null($nomPersonne) && !is_null($prenomPersonne) && !is_null($mailPersonne) && !is_null($adressepostaleAdherent) && !is_null($PW_Adherent)) {
            $this->idAdherent = $idAdherent;
            $this->idPersonne = new ModelPersonne($idPersonne, $nomPersonne, $prenomPersonne, $mailPersonne);
            $this->adressepostaleAdherent = $adressepostaleAdherent;
            $this->PW_Adherent = $PW_Adherent;
        }
    }

    public function save()
    {
    $sql = "INSERT INTO Adherents (idAdherent, idPersonne, adressepostaleAdherent, PW_Adherent) VALUES (:nom_tag1 ,:nom_tag2,:nom_tag3,:nom_tag4)";
    
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
    
    $values = array(
        "nom_tag1" => $this->idAdherent,     
        "nom_tag2" => $this->idPersonne,
        "nom_tag3" => $this->adressepostaleAdherent,
        "nom_tag4" => $this->PW_Adherent,
        //nomdutag => valeur, ...
    );
    
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);
    }

    /**
     * @return null
     */
    public function checkPW($adh)
    {

        $sql = "SELECT * FROM Adherent WHERE login=:login";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $data = array(
            "login" => $login,);
        // On donne les valeurs et on exécute la requête
        $req_prep->execute($data);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');

        $tab = $req_prep->fetchAll();

        return $tab[0]->login==$login && Security::chiffrer($tab[0]->password)==$mot_de_passe_chiffre;

    }
}
?>