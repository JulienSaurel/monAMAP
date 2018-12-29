<?php 
    require_once File::build_path(array('model','ModelContrat.php'));
	require_once File::build_path(array('controller','ControllerMonProfil.php'));

class ControllerNosContrats
{
    protected static $object='nosContrats';
    public static function display()
    {
        $controller ='nosContrats';
        $view = 'contrats';
        $pagetitle = 'Nos Contrats';
        require File::build_path(array('view','view.php')); 
    }
    public static function display1st()
    {
        $controller ='nosContrats';
        $view = 'laitier';
        $pagetitle = 'Nos Contrats';
        require File::build_path(array('view','view.php')); 
    }
    public static function display2nd()
    {
        $controller ='nosContrats';
        $view = 'viande';
        $pagetitle = 'Nos Contrats Viande';
        require File::build_path(array('view','view.php')); 
    }
    public static function display3rd()
    {
        $controller ='nosContrats';
        $view = 'legumes';
        $pagetitle = 'Nos Contrats Légumes';
        require File::build_path(array('view','view.php')); 
    }
    public static function display4th()
    {
        $controller ='nosContrats';
        $view = 'mix';
        $pagetitle = 'Nos Contrats Mix';
        require File::build_path(array('view','view.php')); 
    }

    public static function display5th()
    {
        $controller ='nosContrats';
        $view = 'souscrire';
        $pagetitle = 'Souscrire à un de nos contrats';
        require File::build_path(array('view','view.php')); 
    }

     public static function error()
    {
    $controller ='nosContrats';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
    
    public static function souscripted(){
        
        if (isset($_SESSION['login'])){

            $type = $_GET['typeContrat'];
            $taille = $_GET['tailleContrat'];
            $frequence = $_GET['frequenceContrat'];

           

            $a = ModelAdherent::select($_SESSION['login']);
            //var_dump($a);
            $idAdherent = $a->get('mailPersonne');
			$mailPersonne = $a->get('mailPersonne');
			
			// on récupère la Personne correspondante pour avoir son nom et prénom
			$p = ModelAdherent::getPersonneByIdAdh($idAdherent);
            $prenomPersonne = $p->get('prenomPersonne');
            
		
        ////////////////// ENVOI DE MAIL ////////////////////////////////////////             
        $to  = $mailPersonne; 
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
                <p> L'.$quote.'équipe de AMAP Occitanie vous confirme que vous avez bien sourscrit à un contrat '.$type.' de taille '.$taille.' à une fréquence '.$frequence.'. </p>
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

        //////////////FIN D'ENVOI DE MAIL ///////////////////////////////////
		
            $arraycontrat = [
            'idAdherent' => $idAdherent,
            'typeContrat' => $type,
            'tailleContrat' => $taille,
            'frequenceContrat' => $frequence,
            ];

            ModelContrat::save($arraycontrat);
            $view = 'souscripted';
            $pagetitle = 'Merci !';
            require File::build_path(array('view','view.php'));
        } else {

        }
    }
	
	/**
	 * Résilie un contrat et renvoie vers la vue MonProfil
	 * 
     */
	public static function resilier(){
		$idContr = $_GET['idC'];
		ModelContrat::resilier($idContr);
		ControllerMonProfil::profile();
	}
	
    public static function generePDF(){
        include_once('libExternes/phpToPDF/phpToPDF.php');
    // quelques remarques :
    // 1. FPDF ne gère pas les accents => utilisation de utf8_decode()
    // 2. FPDF de gère pas le caractère € => chr(128)
    
    // création de la page et définition d'éléments
    ob_get_clean();
    $PDF=new phpToPDF();
    $PDF->SetFillColor( 197, 223, 179 );
    $PDF->AddPage();
    $PDF->SetFont('Arial','BI',13);
    
    // quelques constantes propres à notre présentation
    $esp = 12;
    $hau = 8;
    
    // insertion d'une image :
    // $PDF->Image($url,x,y,w,h);
    //$PDF->Image($url,180,10,15,5);
    
    // pour ajouter une ligne de texte de dim 40 x 10. 
    // 0 = non encadré, 1 = encadré
    // 'L' = left, 'C' = center, 'R' = right
    $tab="                 ";
    $pointL="................................................................";
    $pointXS=".......................";
    // le titre
    $PDF->SetFont('Arial','B',16);
    $PDF->Cell(500,$hau,"monAMAP d'Occitanie ",0,0,'L');
    
    // retour à la ligne
    $PDF->Ln($esp);
    $PDF->SetFont('Arial','B',13);
    // date  
    //$PDF->Cell(190,$hau,"le ".date("d M Y\, H:i:s"),0,0,'L');
    $PDF->Ln(14);
    // descriptif de l'adhérent 
    /*
    $strAdh = $adh['prenom']." ".$adh['nom'].", ".$adh['adresse']." ".$adh['cp']." ".$adh['ville'];
    $PDF->Cell(190,$hau,utf8_decode("adhérent : ".$strAdh),0,0,'L');
    $PDF->Ln($esp);
    */
    $PDF->SetFont('Arial','B',19);
    $PDF->Cell(190,$hau,utf8_decode("Souscrire à un contrat"),0,0,'C');
    $PDF->SetFont('Arial','B',13);
    $PDF->Ln(14);
    $PDF->Cell(190,$hau,utf8_decode("Informations contrat: "),0,0,'L');
    $PDF->Ln(10);
    $PDF->SetFont('Arial','',13);
    $PDF->Cell(190,$hau,$tab."Type de contrat: ".$pointXS,0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Fréquence du contrat:").$pointXS,0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Taille des paniers : ").$pointXS,0,0,'L');
    $PDF->Ln(18);
    $PDF->SetFont('Arial','B',13);
    $PDF->Cell(190,$hau,utf8_decode("Informations adhérent: "),0,0,'L');
    $PDF->SetFont('Arial','',13);
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab."Nom : ".$pointL,0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Prénom")." : ".$pointL,0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Adresse électronique : ".$pointL),0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Téléphone : ".$pointXS),0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Adresse : ".$pointL),0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Ville : ".$pointL),0,0,'L');
    $PDF->Ln(10);
    $PDF->Cell(190,$hau,$tab.utf8_decode("Code postal : ".$pointXS),0,0,'L');
    $PDF->Ln(20);
    $PDF->Cell(190,$hau,utf8_decode("Je déclare avoir pris connaissance des Conditions Générales de Vente décrites "),0,0,'L');
    $PDF->Ln(7);
    $PDF->Cell(190,$hau,utf8_decode("et les accepte pleinement. "),0,0,'L');
    $PDF->Ln(30);
    $PDF->SetFont('Arial','B',13);
    $PDF->Cell(190,$hau,utf8_decode("Tampon de l'association : "),0,0,'L');
    $PDF->Ln(1);
    $PDF->Cell(190,$hau,utf8_decode("Signature de l'adhérent : "),0,0,'R');
    $PDF->Ln(6);
    $PDF->SetFont('Arial','',8);
    $PDF->Cell(190,$hau,utf8_decode("(précédé de la mention \" lu et approuvé \" ainsi que de la date du jour)"),0,0,'R');
    
    // export du pdf avec sauvegarde selon le nom spécifié
    $namefile = "facture.pdf";
    $PDF->Output($namefile, "I");
    // affichage du pdf
    echo '<embed src="facture.pdf" width="100%" height="900px">';
    }
} ?>