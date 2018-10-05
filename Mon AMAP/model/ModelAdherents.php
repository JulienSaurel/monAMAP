<?php

require_once 'ModelPersonne.php';

class ModelAdherents 
{

    private $idAdherent;
    private $idPersonne;
    private $adressepostaleAdherent;
    private $PW_Adherent;

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
    public function __construct($idAdherent /*= NULL*/, $idPersonne /*= NULL*/, $nomPersonne, $prenomPersonne, $mailPersonne, $adressepostaleAdherent /*= NULL*/, $PW_Adherent /*= NULL*/) 
    {
        /*if (!is_null($idAdherent) && !is_null($idPersonne) && !is_null($adressepostaleAdherent) && !is_null($PW_Adherent)) {*/
            $this->idAdherent = $idAdherent;
            $this->idPersonne = new ModelPersonne($idPersonne, $nomPersonne, $prenomPersonne, $mailPersonne);
            $this->adressepostaleAdherent = $adressepostaleAdherent;
            $this->PW_Adherent = $PW_Adherent;
        //}
    }

    static public function getAdherentById($idPersonne) 
    {
    $sql = "SELECT * from Personne WHERE idAdherent=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $idAdherent,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdherents');
    $tab_adh = $req_prep->fetchAll();
    // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_adh)) 
        {
            return false;
        }
        return $tab_adh[0];
    }

    // une methode d'affichage.
    public function afficher() 
    {
        echo "Adherent: {$this->idAdherent}: " . $this->idPersonne->toString() . "adresse postale :  {$this->adressepostaleAdherent}\n";
    }

    public function toString() 
    {
    	return ("Adherent: {$this->idAdherent}: " . $this->idPersonne->toString() . "\n");
    }
}