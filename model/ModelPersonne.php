<?php

require_once File::build_path(array('model','Model.php'));

class ModelPersonne extends Model 
{

    private $idPersonne;
    private $nomPersonne;
    private $prenomPersonne;
    private $mailPersonne;
    static protected $object = 'personne';
    protected static $primary='idPersonne';

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
    public function __construct($nomPersonne = NULL, $prenomPersonne = NULL, $mailPersonne = NULL)
    {
        if (!is_null($nomPersonne) && !is_null($prenomPersonne) && !is_null($mailPersonne)) {
        	$this->idPersonne = self::generateId();
            $this->nomPersonne = $nomPersonne;
            $this->prenomPersonne = $prenomPersonne;
            $this->mailPersonne = $mailPersonne;
        }
    }

    public static function generateId()
    {
    	$sql = 'SELECT SUM(idPersonne) FROM Personne';
    	$req = Model::$pdo->query($sql);
    	$res = $req->fetchColumn();
    	if ($res)
	    {
	    	if($res != 1)
			    return $res;
	    	return 2;
	    }
    	return 1;
    }


	/*static public function getPersonneById($idPersonne)
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
	// S'il n'y a pas de résultats, on renvoie false
		if (empty($tab_pers))
		{
			return false;
		}
		return $tab_pers[0];
	}*/

    public function save() {
    $sql = "INSERT INTO Personne (idPersonne, nomPersonne, prenomPersonne, mailPersonne) VALUES (:idPersonne, :nomPersonne, :prenomPersonne, :mailPersonne)";

    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
    	"idPersonne" => $this->idPersonne,
        "nomPersonne" => $this->nomPersonne,
        "prenomPersonne" => $this->prenomPersonne,
        "mailPersonne" => $this->mailPersonne,
    );
    
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);
}

    /*static public function getAllPersonnes() {

        $rep = Model::$pdo->query('SELECT * FROM Personne');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelPersonne');
        $tab_pers = $rep->fetchAll();



        return $tab_pers;
    }*/
    // // une methode d'affichage.
    // public function afficher() 
    // {
    //     echo "{$this->idPersonne}: {$this->prenomPersonne} {$this->nomPersonne} \n mail: {$this->mailPersonne} ";
    // }

    /*public function toString() 
    {
        return ("{$this->idPersonne}: {$this->prenomPersonne} {$this->nomPersonne} \n mail: {$this->mailPersonne} ");
    }*/
}
?>