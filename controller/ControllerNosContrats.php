<?php 
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
     public static function error()
    {
    $controller ='nosContrats';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
    public static function souscripted(){
        //on va chercher l'id de l'adhérent dans la base
        // on crée un contrat (instance de contrat)
        // on l'enregistre dans la base
        // on redirige vers une page type "merci !"
        // VÉRIFIER SI QLQUN EST CONNECTÉ ET SI OUI RECCUPÉRER SON IDAHERENT
        // ET SON PRENOM DANS DES VARIABLES idAdherent et prenomAdherent
        $type = $_GET['typeContrat'];
        $taille = $_GET['tailleContrat'];
        $frequence = $_GET['frequenceContrat'];
        $instanceContrat = new ModelContrat($idAdherent,$type,$taille,$frequence);
        $instanceContrat->save();
        $view = 'souscripted';
        $pagetitle = 'Merci !';
        require File::build_path(array('view','view.php'));
    }
    public static function generePDF(){
        include_once('libExternes/phpToPDF/phpToPDF.php');
    // quelques remarques :
    // 1. FPDF ne gère pas les accents => utilisation de utf8_decode()
    // 2. FPDF de gère pas le caractère € => chr(128)
    
    // création de la page et définition d'éléments
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
    $PDF->Cell(190,$hau,"le ".date("d M Y\, H:i:s"),0,0,'L');
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
    
    /*
    // descriptif de la facture (identifiant de facure)
    $PDF->Cell(190,$hau,utf8_decode("facture n°".$numFacture),0,0,'L');
    $PDF->Ln($esp);
    // ligne d'entête du tableau
    $PDF->Cell(100,$hau,utf8_decode("article"),1,0,'C',true);
    $PDF->Cell(30,$hau,utf8_decode("quantité"),1,0,'C',true);
    $PDF->Cell(30,$hau,utf8_decode("prix unitaire"),1,0,'C',true);
    $PDF->Cell(30,$hau,utf8_decode("prix total"),1,0,'C',true);
    $PDF->Ln();
    // ligne par article, et calcul du prix total au fur et à mesure
    $prixTotal = 0;
    foreach ($A as $i => $article) {
        $lib = utf8_decode($article['libelleArticle']);
        $qte = $article['quantite'];
        $prU = $article['prixUnitaire'];
        $prT = $qte * $prU;
        $prixTotal += $prT;
        $PDF->Cell(100,$hau,$lib,1,0,'L');
        $PDF->Cell(30,$hau,$qte,1,0,'C');
        $PDF->Cell(30,$hau,number_format($prU,2,',',' ').' '.chr(128),1,0,'R');
        $PDF->Cell(30,$hau,number_format($prT,2,',',' ').' '.chr(128),1,0,'R');
        $PDF->Ln();
    }
    // ligne du prix total
    $PDF->Cell(160,$hau,utf8_decode("total "),0,0,'R',false);
    $PDF->Cell(30,$hau,number_format($prixTotal,2,',',' ').' '.chr(128),1,0,'R');
    */
    // export du pdf avec sauvegarde selon le nom spécifié
    $namefile = "facture.pdf";
    $PDF->Output($namefile, "I");
    // affichage du pdf
    echo '<embed src="facture.pdf" width="100%" height="900px">';
    }
} ?>