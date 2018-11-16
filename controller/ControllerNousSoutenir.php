<?php 
require_once File::build_path(array('model','ModelDonnateur.php')); // chargement du modèle
class ControllerNousSoutenir
{
	protected static $object='nousSoutenir';

	public static function display()
	{
        $view = 'soutenir';
        $pagetitle = 'Nous Soutenir';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
	
	public static function donnated(){
		$nom = $_GET['Nom_donnateur'];
        $prenom = $_GET['Prenom_donnateur'];
        $mail = $_GET['Mail_donnateur'];
		$montant = $_GET['Montant_don'];
		
		if($montant > 0){
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
		
		// Plusieurs destinataires
     $to  = $mail; // notez la virgule
     $quote = "'";
     // Sujet
     $subject = 'Remerciements de monAMAP';

     // message
     $message = '
     <html>
      <head>
       <title>Remerciements de monAMAP</title>
      </head>
      <body>
       <p> L'.$quote.'équipe de l'.$quote.'AMAP monAMAP vous remercie mour votre don de '. $montant .'€ à notre association </p>
      </body>
     </html>
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=iso-8859-1';

     // En-têtes additionnels
     $headers[] = 'From: monAMAP <monAMAP@no-reply.com>';
     // Envoi
     mail($to, $subject, $message, implode("\r\n", $headers));



		$sql="SELECT * FROM donnateur WHERE mailAddressDonnateur=:tag";

    	$req_prep = Model::$pdo->prepare($sql);

    	$valeurs = array(
    		"tag" => $mail);

    	$req_prep->execute($valeurs);
    	$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDonnateur');
		$tab_donn = $req_prep->fetchAll();
		$donnateur = $tab_donn[0];
		
        $view = 'donnated';
        $pagetitle = 'Merci !';
        require File::build_path(array('view','view.php'));
    } else {
        $view = 'erreurMontant';
        $pagetitle = 'Erreur';
        require File::build_path(array('view','view.php'));
    	
    }
}
}
?>