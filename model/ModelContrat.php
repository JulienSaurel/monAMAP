<?php

require_once File::build_path(array('model','Model.php'));

class ModelContrat extends Model 
{

    protected $idContrat;
    protected $idAdherent;
    protected $typeContrat;
    protected $tailleContrat;
    protected $frequenceContrat;
    static protected $object = 'contrat';
    protected static $primary='idContrat';
	
	public static function getContrats($mailAdh){
		$sql = "SELECT * FROM Contrat WHERE idAdherent=:adh";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "adh" => $mailAdh);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelContrat');
        $tabContrat = $req_prep->fetchAll();
		var_dump($tabContrat);
		return $tabContrat;
	}

}

?>






