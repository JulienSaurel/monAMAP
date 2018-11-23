<?php

require_once File::build_path(array('model','Model.php'));

class ModelContrat extends Model 
{

    private idContrat;
    private idAdherent;
    private typeContrat;
    private tailleContrat;
    private frequenceContrat;
    static protected $object = 'contrat';
    protected static $primary='idContrat';

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
    public function __construct($idContrat = NULL, $idAdherent = NULL, $typeContrat = NULL, $tailleContrat = NULL, $frequenceContrat = NULL) 
    {
        if (!is_null($idContrat) && !is_null($idAdherent) && !is_null($typeContrat) && !is_null($tailleContrat) && !is_null($frequenceContrat)) {

            $this->idContrat = $idContrat;
            $this->idAdherent = $idAdherent;
            $this->typeContrat = $typeContrat;
            $this->tailleContrat = $tailleContrat;
            $this->frequenceContrat = $frequenceContrat;
        }
    }
public function save() {    
    $sql = "INSERT INTO contrat (idContrat, idAdherent, typeContrat, tailleContrat, frequenceContrat) VALUES (:nom_tag1 ,:nom_tag2,:nom_tag3,:nom_tag4,:nom_tag5)";
    
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
    
    $values = array(
        "nom_tag1" => $this->idContrat,     
        "nom_tag2" => $this->idAdherent,
        "nom_tag3" => $this->typeContrat,
        "nom_tag4" => $this->tailleContrat,
        "nom_tag4" => $this->frequenceContrat
        //nomdutag => valeur, ...
    );
    
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);
}

}
?>






