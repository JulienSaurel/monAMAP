<?php

require_once 'Personne.php';

class Adherents {

    private $idAdherent;
    private $idPersonne;
    private $adressepostaleAdherent;
    private $PW_Adherent;

    // Getter générique
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($idAdherent /*= NULL*/, $idPersonne /*= NULL*/, $nomPersonne, $prenomPersonne, $mailPersonne, $adressepostaleAdherent /*= NULL*/, $PW_Adherent /*= NULL*/) {
        /*if (!is_null($idAdherent) && !is_null($idPersonne) && !is_null($adressepostaleAdherent) && !is_null($PW_Adherent)) {*/
            $this->idAdherent = $idAdherent;
            $this->idPersonne = new Personne($idPersonne, $nomPersonne, $prenomPersonne, $mailPersonne);
            $this->adressepostaleAdherent = $adressepostaleAdherent;
            $this->PW_Adherent = $PW_Adherent;
        //}
    }

    // une methode d'affichage.
    public function afficher() {
        echo "Adherent: {$this->idAdherent}: " . $this->idPersonne.toString() . "\n";
    }

    public function toString() {
    	return ("Adherent: {$this->idAdherent}: " . $this->idPersonne.toString() . "\n");
    }
}