<?php

require_once File::build_path(array('model','Model.php'));

class ModelDon extends Model
{

    private $idDon;
    private $montantDon;
    private $mailAddressDonnateur;

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
    public function __construct($montantDon = NULL, $mailAddressDonnateur = NULL) 
    {
        if (!is_null($montantDon) && !is_null($mailAddressDonnateur)) {

            $this->montantDon = $montantDon;
            $this->mailAddressDonnateur = $mailAddressDonnateur;			
        }
    }

    /*static public function getDonnateurByMail($mailAddressDonnateur) 
    {
    $sql = "SELECT * from donnateur WHERE mailAddressDonnateur=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $mailAddressDonnateur,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDonnateur');
    $tab_donn = $req_prep->fetchAll();
    // S'il n'y a pas de résultats, on renvoie false
        if (empty($tab_donn)) 
        {
            return false;
        }
        return $tab_donn[0];
    }*/

    public function save() { 
	
		$sql="INSERT INTO don(montantDon,mailAddressDonnateur) VALUES (:montant, :mail);";
		$req_prep = Model::$pdo->prepare($sql);

		$valeurs = array(
			"montant" => $this->montantDon,
			"mail" => $this->mailAddressDonnateur);
		$req_prep->execute($valeurs);
	
}

    /*static public function getAllDonnateurs() {

        $rep = Model::$pdo->query('SELECT * FROM donnateur');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelDonnateur');
        $tab_adh = $rep->fetchAll();



        return $tab_adh;
    }


    public function toString() 
    {
    	return ("Donnateur: {$this->$prenomDonnateur} " . $this->$nomDonnateur ." d'adresse mail : " . $this->$mailAddressDonnateur ."\n");
    }*/
}
?>