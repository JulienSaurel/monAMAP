<?php

require_once File::build_path(array('model','ModelPersonne.php'));

class ModelAdherents extends Model 
{

    private $idAdherent;
    private $nomAdherent;
    private $prenomAdherent;
    private $mailAdressAdherent;
    private $pwAdherent;
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
    public function __construct($nomAdherent = NULL, $prenomAdherent = NULL, $mailAdressAdherent = NULL,
     $pwAdherent = NULL) 
    {
        if (!is_null($nomAdherent) && !is_null($prenomAdherent) && !is_null($mailAdressAdherent) 
            && !is_null($pwAdherent)) {
            $this->idAdherent = $idAdherent;
            $this->idPersonne = new ModelPersonne($idPersonne, $nomPersonne, $prenomPersonne, $mailPersonne);
            $this->adressepostaleAdherent = $adressepostaleAdherent;
            $this->PW_Adherent = $PW_Adherent;
        }
    }

    public function save() {    
    $sql = "INSERT INTO adherent ( nomAdherent, prenomAdherent, mailAdressAdherent, pwAdherent) VALUES (:nom_tag1 ,:nom_tag2,:nom_tag3,:nom_tag4)";
    
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
    
    $values = array(
        "nom_tag1" => $this->nomAdherent,     
        "nom_tag2" => $this->prenomAdherent,
        "nom_tag3" => $this->mailAdressAdherent,
        "nom_tag4" => $this->pwAdherent,
        //nomdutag => valeur, ...
    );
    
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);
}
/*static public function getAdherentById($idAdherent) 
    {
    $sql = "SELECT * from Adherents WHERE idAdherent=:nom_tag";
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
    // S'il n'y a pas de résultats, on renvoie false
        if (empty($tab_adh)) 
        {
            return false;
        }
        return $tab_adh[0];
    }*/

    /*static public function getAllAdherents() {

        $rep = Model::$pdo->query('SELECT * FROM Adherents');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdherents');
        $tab_adh = $rep->fetchAll();



        return $tab_adh;
    }*/

    // une methode d'affichage.
    // public function afficher() 
    // {
    //     echo "Adherent: {$this->idAdherent}: " . $this->idPersonne->toString() . "adresse postale :  {$this->adressepostaleAdherent}\n";
    // }

   /* public function toString() 
    {
    	return ("Adherent: {$this->idAdherent}: " . $this->idPersonne->toString() . "\n");
    }*/
}
?>