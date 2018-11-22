<?php 
require_once File::build_path(array('model','ModelDonnateur.php')); // chargement du modèle
require_once File::build_path(array('model','ModelDon.php')); // chargement du modèle
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

        // création donnateur ou update
		$sql="SELECT COUNT(*) FROM donnateur WHERE mailAddressDonnateur=:tag";

    	$req_prep = Model::$pdo->prepare($sql);

    	$valeurs = array(
    		"tag" => $mail);

    	$req_prep->execute($valeurs);
    	$resultat = $req_prep->fetch();
    	$nbDonnateur = $resultat[0];
		
		if($nbDonnateur == 0){ // si le donnateur n'existe pas on le crée
			$instanceDonnateur = new ModelDonnateur($mail, $nom, $prenom,$montant);
			$instanceDonnateur->save();
		} else { // sinon on l'update 
			$sql="UPDATE donnateur SET montantTotal = montantTotal + :montant WHERE mailAddressDonnateur= :mail;";

			$req_prep = Model::$pdo->prepare($sql);

			$valeurs = array(
				"mail" => $mail,
				"montant" => $montant);

			$req_prep->execute($valeurs);
		}

        $instanceDon = new ModelDon($montant,$mail);
        $instanceDon->save();
		
		// Plusieurs destinataires
     $to  = $mail; // notez la virgule
     $quote = "'";
     // Sujet
     $subject = 'Remerciements de AMAP Occitanie';

     // message
     $message = '
     <html>
      <head>
       <title>Remerciements de AMAP Occitanie</title>
      </head>
      <body>
       <p> L'.$quote.'équipe de AMAP Occitanie vous remercie mour votre don de '. $montant .'€ à notre association </p>
      </body>
      <footer> <p> le site de l'.$quote.'AMAP : http://webinfo.iutmontp.univ-montp2.fr/~robertl/AMAP/monAMAP/</p>
      </footer>
     </html>
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=iso-8859-1';

     // En-têtes additionnels
     $headers[] = 'From: AMAP Occitanie <AMAP-Occitanie@no-reply.com>';
     // Envoi
     mail($to, $subject, $message, implode("\r\n", $headers));


        //self::generePDF(); 


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

    public static function generePDF(){
        $mail = $_GET['mail'];


        $sql="SELECT * FROM donnateur WHERE mailAddressDonnateur=:tag";

        $req_prep = Model::$pdo->prepare($sql);

        $valeurs = array(
            "tag" => $mail);

        $req_prep->execute($valeurs);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDonnateur');
        $tab_donn = $req_prep->fetchAll();
        $donnateur = $tab_donn[0];


        $sql="SELECT * FROM don WHERE mailAddressDonnateur=:tag";

        $req_prep = Model::$pdo->prepare($sql);

        $valeur = array(
            "tag" => $mail);

        $req_prep->execute($valeur);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDon');
        $tab_don = $req_prep->fetchAll();
        $don = $tab_don[0];

        include_once('libExternes/phpToPDF/phpToPDF.php');

    // quelques remarques :
    // 1. FPDF ne gère pas les accents => utilisation de utf8_decode()
    // 2. FPDF de gère pas le caractère € => chr(128)
    

    // l'adhérent à qui s'adresse la facture
    $adh = array(
        'nom' => $donnateur->get('nomDonnateur'),
        'prenom' => $donnateur->get('prenomDonnateur'),
        'email' => $donnateur->get('mailAddressDonnateur')
    );

    // la facture
    $numFacture = $don->get('idDon');
    
    // les articles de la facture
    $A = array();
    $article1 = array(
        'typeMontant' => 'don',
        'montant' => $don->get('montantDon')
    );

    $A[] = $article1;

    // un logo
    //$url = '../images/logo.png';
    
    // création de la page et définition d'éléments
    $PDF=new phpToPDF();
    $PDF->SetFillColor( 197, 223, 179 );
    $PDF->AddPage();
    $PDF->SetFont('Arial','BI',12);
    
    // quelques constantes propres à notre présentation 
    $esp = 12;
    $hau = 8;
    
    // insertion d'une image :
    // $PDF->Image($url,x,y,w,h);
    ///$PDF->Image($url,180,10,15,5);
    
    // pour ajouter une ligne de texte de dim 40 x 10. 
    // 0 = non encadré, 1 = encadré
    // 'L' = left, 'C' = center, 'R' = right
    
    // le titre
    $PDF->Cell(190,$hau,"monAMAP d'Occitanie ",0,0,'L');
    
    // retour à la ligne
    $PDF->Ln($esp);

    // date  
    $PDF->Cell(190,$hau,"le ".date("d M Y\, H:i:s"),0,0,'L');
    $PDF->Ln($esp);

    // descriptif de l'adhérent
    $strAdh = $adh['prenom']." ".$adh['nom'].", ".$adh['email'];
    $PDF->Cell(190,$hau,utf8_decode("donnateur : ".$strAdh),0,0,'L');
    $PDF->Ln($esp);

    // descriptif de la facture (identifiant de facure)
    $PDF->Cell(190,$hau,utf8_decode("don n°".$numFacture),0,0,'L');
    $PDF->Ln($esp);

    // ligne d'entête du tableau
    $PDF->Cell(100,$hau,utf8_decode("Montant du don: "),1,0,'C',true);
    $PDF->Cell(90,$hau,$don->get('montantDon')." ".chr(128),1,0,'C',false);
    $PDF->Ln();

    // ligne par article, et calcul du prix total au fur et à mesure
    $prixTotal = 0;
    foreach ($A as $i => $article) {
        //$lib = utf8_decode($article['libelleArticle']);
        //$qte = $article['quantite'];
        //$prU = $article['prixUnitaire'];
        //$prT = $qte * $prU;
        //$prixTotal += $prT;
        //$PDF->Cell(100,$hau,$lib,1,0,'L');
        //$PDF->Cell(30,$hau,$qte,1,0,'C');
        //$PDF->Cell(30,$hau,number_format($prU,2,',',' ').' '.chr(128),1,0,'R');
        //$PDF->Cell(30,$hau,number_format($prT,2,',',' ').' '.chr(128),1,0,'R');
        $PDF->Ln();
    }

    // ligne du prix total
    //$PDF->Cell(160,$hau,utf8_decode("total "),0,0,'R',false);
    //$PDF->Cell(30,$hau,number_format($prixTotal,2,',',' ').' '.chr(128),1,0,'R');

    // export du pdf avec sauvegarde selon le nom spécifié
    //$namefile = "../files/facturedonnation/facture_$numFacture.pdf";
    $PDF->Output("facture", "I");

    // affichage du pdf
    echo '<embed src="facture".$numFacture.".pdf" width="100%" height="900px">';
    }
}
?>