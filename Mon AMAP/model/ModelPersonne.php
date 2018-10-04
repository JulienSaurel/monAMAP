<?php

require_once 'Model.php';

class ModelPersonne 
{

    private $idPersonne;
    private $nomPersonne;
    private $prenomPersonne;
    private $mailPersonne;

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
    public function __construct($idPersonne = NULL, $nomPersonne = NULL, $prenomPersonne = NULL, $mailPersonne = NULL) 
    {
        if (!is_null($idPersonne) && !is_null($nomPersonne) && !is_null($prenomPersonne) && !is_null($mailPersonne)) {
            $this->idPersonne = $idPersonne;
            $this->nomPersonne = $nomPersonne;
            $this->prenomPersonne = $prenomPersonne;
            $this->mailPersonne = $mailPersonne;
        }
    }


    static public function getPersonneById($idPersonne) 
    {
    $sql = "SELECT * from Personne WHERE idPersonne=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $idPersonne,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPersonne');
    $tab_pers = $req_prep->fetchAll();
    // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_pers)) 
        {
            return false;
        }
        return $tab_pers[0];
    }

    public function save() {    
    $sql = "INSERT INTO Personne (idPersonne, nomPersonne, prenomPersonne, mailPersonne) VALUES (:nom_tag1 ,:nom_tag2,:nom_tag3,:nom_tag4)";
    
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
    
    $values = array(
        "nom_tag1" => $this->idPersonne,     
        "nom_tag2" => $this->nomPersonne,
        "nom_tag3" => $this->prenomPersonne,
        "nom_tag4" => $this->mailPersonne,
        //nomdutag => valeur, ...
    );
    
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);
}

    static public function getAllPersonnes() {

        $rep = Model::$pdo->query('SELECT * FROM Personne');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelPersonne');
        $tab_pers = $rep->fetchAll();



        return $tab_pers;
    }
    // // une methode d'affichage.
    // public function afficher() 
    // {
    //     echo "{$this->idPersonne}: {$this->prenomPersonne} {$this->nomPersonne} \n mail: {$this->mailPersonne} ";
    // }

    public function toString() 
    {
        return ("{$this->idPersonne}: {$this->prenomPersonne} {$this->nomPersonne} \n mail: {$this->mailPersonne} ");
    }
}