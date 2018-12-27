<?php

require_once File::build_path(array('model','Model.php'));

class ModelDonnateur extends Model
{

    protected $mailAddressDonnateur;
    protected $nomDonnateur;
    protected $prenomDonnateur;
    protected $montantTotal;
    static protected $object = 'donnateur';
    protected static $primary='mailAddressDonnateur';

	
	/* 
		vérifie si $mail est déjà présente dans la base de données
		
		@param l'adresse mail $mail à vérifier
		@return le nombre d'occurences de $mail dans la table Donnateur
	*/
    public static function count($mail)
    {
        $sql="SELECT COUNT(*) FROM Donnateur WHERE mailAddressDonnateur=:tag";

        $req_prep = Model::$pdo->prepare($sql);

        $valeurs = array(
            "tag" => $mail);

        $req_prep->execute($valeurs);
        $resultat = $req_prep->fetch();

        return $resultat[0];
    }

}
?>