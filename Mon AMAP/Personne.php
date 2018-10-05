<?php


class Personne {

    private $idPersonne;
    private $nomPersonne;
    private $prenomPersonne;
    private $mailPersonne;

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
    public function __construct($idPersonne, $nomPersonne /*= NULL*/, $prenomPersonne /*= NULL*/, $mailPersonne /*= NULL*/) {
        /*if (!is_null($idPersonne) && !is_null($nomPersonne) && !is_null($prenomPersonne) && !is_null($mailPersonne)) {*/
            $this->idPersonne = $idPersonne;
            $this->nomPersonne = $nomPersonne;
            $this->prenomPersonne = $prenomPersonne;
            $this->mailPersonne = $mailPersonne;
        //}
    }

    // une methode d'affichage.
    public function afficher() {
        echo "{$idPersonne}: {$this->prenomPersonne} {$this->nomPersonne} \n mail: {$this->mailPersonne} ";
    }

    public function toString() {
        return ("{$idPersonne}: {$this->prenomPersonne} {$this->nomPersonne} \n mail: {$this->mailPersonne} ");
    }
}