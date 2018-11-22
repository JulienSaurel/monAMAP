<?php

require_once File::build_path(array('model','Model.php'));

class ModelLivreDor extends Model
{

    private $message;
    private $id_message;
	private $pseudo;
    private static $nbmessagepage = 5;
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
    public function __construct($pseudo = NULL, $message = NULL) 
    {
        if (!is_null($message) && !is_null($pseudo)) {
            $this->message = $message;
			$this->pseudo = $pseudo;
			
        }
    }

    public static function getnbmsgpg()
    {
        return self::$nbmessagepage;
    }

    public function save() { 
	
		$sql="INSERT INTO LivreDor(message,pseudo) VALUES (:msg,:author);";
		$req_prep = Model::$pdo->prepare($sql);

		$valeurs = array(
			"msg" => $this->message,
			"author" => $this->pseudo);
		$req_prep->execute($valeurs);
	
}

    public static function getNbPages()
    {
        
        $totalDesMessages = self::countAll();
        $nombreDePages = ceil($totalDesMessages / self::$nbmessagepage);
        //var_dump($nombreDePages);
        
        return $nombreDePages;
    }

    public static function getAllBetween($deb, $fin)
    {     
        $sql = 'SELECT * FROM LivreDor ORDER BY id_message DESC LIMIT ' . $deb . ', ' . ($fin-$deb);
        

        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();
        
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelLivreDor');
        

        $tab = $req_prep->fetchAll();
        return $tab;
    }
}
?>