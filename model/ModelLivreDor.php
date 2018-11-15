<?php

require_once File::build_path(array('model','Model.php'));

class ModelLivreDor extends Model
{

    private $message;
    private $date;
    private $id;
	private $idAuteur;
    private static $nbmessagepage = 5;
    static protected $object = 'livreDor';
    protected static $primary='id';

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

    public static function getNbPages()
    {
        
        $totalDesMessages = self::countAll();
        $nombreDePages = ceil($totalDesMessages / self::$nbmessagepage);
        //var_dump($nombreDePages);
        
        return $nombreDePages;
    }
}
?>