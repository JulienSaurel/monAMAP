<?php 
require_once File::build_path(array('model','ModelDonnateur.php')); // chargement du modèle
class ControllerNousSoutenir
{
	public static function display()
	{
		$controller ='nousSoutenir';
        $view = 'soutenir';
        $pagetitle = 'Nous Soutenir';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $controller ='nousSoutenir';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
	
	public static function donnated(){
		$nom = $_GET['Nom_donnateur'];
        $prenom = $_GET['Prenom_donnateur'];
        $mail = $_GET['Mail_donnateur'];
		$montant = $_GET['Montant_don'];
		
		$sql="SELECT COUNT(*) FROM donnateur WHERE mailAddressDonnateur=:tag";

    	$req_prep = Model::$pdo->prepare($sql);

    	$valeurs = array(
    		"tag" => $mail);

    	$req_prep->execute($valeurs);
    	$resultat = $req_prep->fetch();
    	$nbDonnateur = $resultat[0];
		
		if($nbDonnateur == 0){
			$instanceDonnateur = new ModelDonnateur($mail, $nom, $prenom,$montant);
			$instanceDonnateur->save();
		} else {
			$sql="UPDATE donnateur SET montantTotal = montantTotal + :montant WHERE mailAddressDonnateur= :mail;";

			$req_prep = Model::$pdo->prepare($sql);

			$valeurs = array(
				"mail" => $mail,
				"montant" => $montant);

			$req_prep->execute($valeurs);
		}
		
		$sql="SELECT * FROM donnateur WHERE mailAddressDonnateur=:tag";

    	$req_prep = Model::$pdo->prepare($sql);

    	$valeurs = array(
    		"tag" => $mail);

    	$req_prep->execute($valeurs);
    	$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDonnateur');
		$tab_donn = $req_prep->fetchAll();
		$donnateur = $tab_donn[0];
		
		$controller ='nousSoutenir';
        $view = 'donnated';
        $pagetitle = 'Merci !';
        require File::build_path(array('view','view.php'));
	}
} ?>