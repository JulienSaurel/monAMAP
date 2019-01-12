<?php 
class ControllerNousConnaitre
{
	protected static $object='nousConnaitre';

	public static function presentation()
	{
		$controller ='nousConnaitre';
        $view = 'connaitre';
        $pagetitle = 'Nous Connaitre';
        require File::build_path(array('view','view.php')); 
	}

	public static function AMAPstory()
	{
		$controller ='nousConnaitre';
        $view = 'lamap';
        $pagetitle = 'L\'amap';
        require File::build_path(array('view','view.php')); 
	}

	public static function contactus()
	{
		$controller ='nousConnaitre';
        $view = 'nousContacter';
        $pagetitle = 'Nous Contacter';
        require File::build_path(array('view','view.php')); 
	}

	public static function findus()
	{
		$controller ='nousConnaitre';
        $view = 'nousTrouver';
        $pagetitle = 'Nous Trouver';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $controller ='nousConnaitre';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }

    public static function contacted(){
    	$mailAdmin = ModelAdherent::getMailAdmin();
    	

    	$chaineMailAdmin = ModelAdherent::chaineMail($mailAdmin);
        //var_dump($chaineMailAdmin);

    	if (isset($_GET['prenom'])){
    		$prenom = $_GET['prenom'];
    	}else {
    		$prenom = 'M/Mme';
    	}

    	if( isset($_GET['nom'])){
    		$nom = $_GET['nom'];
    	}else{
    		$nom = 'Anonyme';
    	}

    	$mail = $_GET['mail'];
    	$message = $_GET['message'];

    	$to  = $chaineMailAdmin; 
    	//var_dump($to);
        $quote = "'";
        // Sujet
        $subject = 'Demande de contact via AMAP Occitanie';

        // message
        $message = '
        <html>
            <head>
              <title>L'.$quote.'utilisateur '.$prenom.' '.$nom.' souhaite vous contacter</title>
            </head>
            <body>
                <h4> Voici le contenu du message envoyé:  </h4>
                <p> '.$message.'</p>
            </body>
            <footer> <p> le site de l'.$quote.'AMAP : http://webinfo.iutmontp.univ-montp2.fr/~robertl/AMAP/monAMAP/</p>
            </footer>
        </html>
        ';

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // En-têtes additionnels
        $headers[] = 'From: '.$prenom.' '.$nom.' <'.$mail.'>';
        // Envoi
        mail($to, $subject, $message, implode("\r\n", $headers));

        $view = 'contacted';
        $pagetitle = 'Merci !';
        require File::build_path(array('view','view.php'));

    }

	
} ?>