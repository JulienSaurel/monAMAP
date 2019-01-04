<?php

require_once File::build_path(array('model','Model.php'));

class ModelPersonne extends Model 
{

    protected $nomPersonne;
    protected $prenomPersonne;
    protected $mailPersonne;
    static protected $object = 'personne';
    protected static $primary='mailPersonne';

	
	
	/**
		vérifie si $mail est déjà présente dans la base de données
		
		@param l'adresse mail $mail à vérifier
		@return booléen, true si l'adresse mail n'existe pas déja, false sinon
	*/
	
	public static function checkMail($mail){ 
		$sql = "SELECT COUNT(*) FROM Personne WHERE mailPersonne=:mail";

 		// Préparation de la requête
         $req_prep = Model::$pdo->prepare($sql);

 	    $values = array(
             "mail" => $mail,
         );
 	    // On donne les valeurs et on exécute la requête
 	    $req_prep->execute($values);
		$res = $req_prep->fetch();
        //var_dump($res[0]);
		
		if($res[0] == 0){ 
			return true;
		} else {
			return false;
		}
	}

}
?>