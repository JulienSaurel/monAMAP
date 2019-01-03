<?php 
require_once File::build_path(array('model','ModelDonnateur.php')); // chargement du modèle
require_once File::build_path(array('model','ModelDon.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
class ControllerNousSoutenir
{
	protected static $object='nousSoutenir';

	/* 
		Redirige vers la vue de donnation
	*/
	public static function display()
	{
        $view = 'soutenir';
        $pagetitle = 'Nous Soutenir';
        require File::build_path(array('view','view.php')); 
	}

	/* 
		redirige vers la page d'erreur
	*/
	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
	
	/* 
		Crée ou update le donnateur, lui envoie un mail de remerciements et redirige vers la page de remerciements
	*/
	public static function donnated(){
		$nom = $_GET['Nom_donnateur']; //on récupère les données passées dans le formulaire
        $prenom = $_GET['Prenom_donnateur'];
        $mail = $_GET['Mail_donnateur'];
		$montant = $_GET['Montant_don'];
		
		if($montant > 0){ // si le montant est correct

        // création donnateur ou update

    	$nbDonnateur = ModelDonnateur::count($mail);
    	//passe

		if($nbDonnateur == 0){ // si le donnateur n'existe pas on le crée
		    $arraypersonne = [
                'mailPersonne' => $mail,
                'nomPersonne' => $nom,
                'prenomPersonne' => $prenom,
            ];

		    ModelPersonne::save($arraypersonne);

			$arraydonnateur = [
                'mailAddressDonnateur' => $mail,
                'montantTotal' => $montant,
            ];
			ModelDonnateur::save($arraydonnateur);

		} else { // sinon on l'update
            $d = ModelDonnateur::select($mail);

            $valeurs = array(
                "mailAddressDonnateur" => $mail,
                "montantTotal" => $montant + $d->get('montantTotal'),
            );

            ModelDonnateur::update($valeurs);
		}

		$arraydon = [
            'mailAddressDonnateur' => $mail,
            'montantDon' => $montant,
        ];
        ModelDon::save($arraydon);

        //envoi de mail
		
        $to  = $mail; 
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


        // génération de la page de remerciments 



		$donnateur = ModelDonnateur::select($mail);


        $view = 'donnated';
        $pagetitle = 'Merci !';
        require File::build_path(array('view','view.php'));
    } else {
        $view = 'erreurMontant';
        $pagetitle = 'Erreur';
        require File::build_path(array('view','view.php'));
    	
    }
}

    /* 
		Génère le recu de la donnation dans un nouvel onglet
	*/
	public static function generePDF(){
        $mail = $_GET['mail'];

        $donnateur = ModelDonnateur::select($mail);
        $personne = ModelAdherent::getPersonneByIdAdh($mail);
        $don = ModelDon::getLastDonFrom($mail);


    include_once('libExternes/phpToPDF/phpToPDF1.php');

    
    // l'adhérent à qui s'adresse la facture
    $adh = array(
        'nom' => $personne->get('nomPersonne'),
        'prenom' => $personne->get('prenomPersonne'),
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
    ob_get_clean();
            
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
    $PDF->SetFont('Arial','B',18);
    // le titre
    $PDF->Cell(190,$hau,"monAMAP d'Occitanie ",0,0,'L');
    
    // retour à la ligne
    $PDF->Ln($esp);

    // date
    $PDF->SetFont('Arial','B',12);  
    $PDF->Cell(190,$hau,"le ".date("d M Y\, H:i:s"),0,0,'L');
    $PDF->Ln($esp);
    $PDF->SetFont('Arial','B',20); 
    $PDF->Cell(190,$hau,utf8_decode("Reçu de la donnation"),0,0,'C');
    $PDF->SetFont('Arial','',14);
    // descriptif de l'adhérent
    $PDF->Ln(16);
    $strAdh = $adh['prenom']." ".$adh['nom'].", ".$adh['email'];
    $PDF->Cell(190,$hau,utf8_decode("donnateur : ".$strAdh),0,0,'L');
    $PDF->Ln(20);

    // descriptif de la facture (identifiant de facure)
    $PDF->Cell(190,$hau,utf8_decode("don n°".$numFacture),0,0,'L');
    $PDF->Ln(20);

    // ligne d'entête du tableau
    $PDF->Cell(100,$hau,utf8_decode("Montant du don: "),1,0,'C',true);
    $PDF->Cell(90,$hau,$don->get('montantDon')." ".chr(128),1,0,'C',false);
    $PDF->Ln();

    // ligne par article, et calcul du prix total au fur et à mesure
    $prixTotal = 0;
    foreach ($A as $i => $article) {
        $PDF->Ln();
    }

    // export du pdf avec sauvegarde selon le nom spécifié
    //$namefile = "../files/facturedonnation/facture_$numFacture.pdf";
    $PDF->Output("facture", "I");

    // affichage du pdf
    echo '<embed src="facture".$numFacture.".pdf" width="100%" height="900px">';
    }
}
?>