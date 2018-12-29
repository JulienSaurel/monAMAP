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
	
	/**
	 * renvoie tous les contrats relatids à un adhérent
	 * @param adresse mail de l'adhérent
     * @return un tableau de ModelContrat 
     */
	public static function getContrats($mailAdh){
		$sql = "SELECT * FROM Contrat WHERE idAdherent=:adh AND encours=1";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "adh" => $mailAdh);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelContrat');
        $tabContrat = $req_prep->fetchAll();
		//var_dump($tabContrat);
		return $tabContrat;
	}

	/**
	 * Résilie un contrat en passant l'attribut encours de la BDD à 0
	 * @param l'identifiant du contrat à résilier
     * 
     */
	public static function resilier($idContr){
		$sql = "UPDATE Contrat SET encours = 0 WHERE idContrat=:contr";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "contr" => $idContr);
        $req_prep->execute($values);
	}
}

?>






