<?php

require_once File::build_path(array('model','Model.php'));

class ModelContrat extends Model 
{

    private $idContrat;
    private $idAdherent;
    private $typeContrat;
    private $tailleContrat;
    private $frequenceContrat;
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
    public function __construct( $idAdherent = NULL, $typeContrat = NULL, $tailleContrat = NULL, $frequenceContrat = NULL) 
    {
        if (!is_null($idAdherent) && !is_null($typeContrat) && !is_null($tailleContrat) && !is_null($frequenceContrat)) {

            $this->idAdherent = $idAdherent;
            $this->typeContrat = $typeContrat;
            $this->tailleContrat = $tailleContrat;
            $this->frequenceContrat = $frequenceContrat;
        }
    }
    
public function save() {    
    $sql = "INSERT INTO contrat (tailleContrat, typeContrat, frequenceContrat, idAdherent) VALUES (:taille, :type, :freq, :adh)";
    
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);
    
    $values = array(    
        "taille" => $this->tailleContrat,
        "type" => $this->typeContrat,
        "freq" => $this->frequenceContrat,
        "adh" => $this->idAdherent
        //nomdutag => valeur, ...
    );

    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);
}

}
?>






