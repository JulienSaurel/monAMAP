<?php

require_once File::build_path(array('model','Model.php'));

class ModelLivreDor extends Model
{

    private $message;
    private $date;
    private $id_message;
	private $idAuteur;
    static protected $object = 'livreDor';
    protected static $primary='id_message';

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
    public function __construct($message = NULL, $date = NULL, $id_message = NULL, $idAuteur = NULL) 
    {
        if (!is_null($message) && !is_null($date) && !is_null($id_message)) {
            $this->message = $message;
            $this->date = $date;
            $this->id_message = $id_message;
			$this->idAuteur = $idAuteur;
			
        }
    }

    /*static public function getMessageById($idMess) 
    {
    $sql = "SELECT * from livreDor WHERE id_message=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $idMess,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête     
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelLivreDor');
    $tab_mess = $req_prep->fetchAll();
    // S'il n'y a pas de résultats, on renvoie false
        if (empty($tab_mess)) 
        {
            return false;
        }
        return $tab_mess[0];
    }*/

    public function save() { 
	
		$sql="INSERT INTO livreDor(message,date,id_message,idAuteur) VALUES (:msg, :date, :idMess, :author);";
		$req_prep = Model::$pdo->prepare($sql);

		$valeurs = array(
			"msg" => $this->message,
			"date" => $this->date,
			"idMess" => $this->id_message,
			"author" => $this->idAuteur);
		$req_prep->execute($valeurs);
	
}

    /*static public function getAllMessages() {

        $rep = Model::$pdo->query('SELECT * FROM livreDor');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelLivreDor');
        $tab_mess = $rep->fetchAll();



        return $tab_mess;
    }
*/
    /*
    public function toString() 
    {
    	return ("Donnateur: {$this->$prenomDonnateur} " . $this->$nomDonnateur ." d'adresse mail : " . $this->$mailAddressDonnateur ."\n");
    }*/
}
?>