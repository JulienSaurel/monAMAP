<?php

require_once File::build_path(array('model','Model.php'));

class ModelProduit extends Model 
{


    private $idProduit;
    private $photo;
    private $description;
    private $idAdherent;
    private $categorie;
    static protected $object = 'produit';
    protected static $primary='idProduit';

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


    static public function getAllProduit() {
        $SQL_request = " SELECT * FROM Produit";
        $rep = Model::$pdo->query($SQL_request);
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $tab_prod = $rep->fetchAll();
        return $tab_prod;
    }

}



?>
