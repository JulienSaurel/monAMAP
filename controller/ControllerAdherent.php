<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once File::build_path(array('model','ModelAdherent.php'));// chargement du modèle
require_once File::build_path(array('model','ModelPersonne.php'));// chargement du modèle
require_once File::build_path(array('controller','ControllerMonProfil.php'));// chargement du modèle
require_once File::build_path(array('controller','ControllerAdmin.php'));// chargement du modèle
require_once File::build_path(array('libExternes', 'PHPMailer-master','src','MailerLoader.php'));


class ControllerAdherent
{
	protected static $object='adherent';

	public static function readAll()
	{
		$tab_adh = ModelAdherent::selectAll();
		//appel au modèle pour gerer la BD
		$view='list';
		$pagetitle = 'Liste des adhérents';
		require File::build_path(array('view', 'view.php'));
		//"redirige" vers la vue list.php qui affiche la liste des adherents
	}

	public static function read()
	{
		$a = $_GET['idAdherent'];
		$a = ModelAdherent::select($a);
		//appel au modèle pour gerer la BD
		if(!$a)
			return self::error();
		$view = 'detail';
		$pagetitle = 'Personne';
		require File::build_path(array('view','view.php'));
		//"redirige" vers la vue qui affiche les details d'un adherent
	}

	/**
	 *  Redirige vers une page d'inscription
	 */
	public static function create()
	{
		//redirection vers le formulaire d'inscription
		$view = 'create';
		$pagetitle = 'S\'inscrire';
		require File::build_path(array('view','view.php'));
	}

	/**affichage de la page de paiement de la cotisation
	 *
	 */
	/* public static function payment(){
	// 	$view = 'payment';
	// 	$pagetitle = 'payez la cotisation';
	// 	require File::build_path(array('view','view.php'));
	// }
	*/

	/**
	 * action d'inscription
	 */
	public static function created()
	{
		//si l'adresse mail existe déjà on ramene a la page d'erreur
		if (ModelPersonne::checkMail($_POST['mailPersonne']) == false ){
			return self::error();
		}

		//si un des deux mots de passes n'est pas renseigné on ramene a la page d'erreur
		if (!isset($_POST['PW_Adherent'])||!isset($_POST['PW_Adherent2'])) {
			return self::error();
		}

		//s'ils ne sont pas identiques on ramene a la page d'erreur
		if ($_POST['PW_Adherent'] !== $_POST['PW_Adherent2'])
			return self::error();

		//si il manque des données on ramene a la page d'erreur
		if (!isset($_POST['idAdherent']) || !isset($_POST['adressepostaleAdherent']) || !isset($_POST['ville']) || !isset($_POST['PW_Adherent']))
			return self::error();

		//si on a pas toutes les infos sur la personne on ramene sur la page d'erreur
		if (!isset($_POST['nomPersonne'])|| !isset($_POST['prenomPersonne']) || !isset($_POST['mailPersonne']))
			return self::error();



		//////////////////////////////
		//Traitement de la personne//
		////////////////////////////

		//on les récupere dans des variables
		$nomPersonne = $_POST['nomPersonne'];
		$prenomPersonne = $_POST['prenomPersonne'];
		$mailPersonne = $_POST['mailPersonne'];

		//on en fait un tableau
		$arrayPersonne = [
			'nomPersonne' => $nomPersonne,
			'prenomPersonne' => $prenomPersonne,
			'mailPersonne' => $mailPersonne,
		];

		//on l'enregistre dans la bdd
		ModelPersonne::save($arrayPersonne);


		///////////////////////////////
		//Traitement des producteurs//
		/////////////////////////////
		if (isset($_POST['estProducteur']))
		{// si on a la donnée a traité

			//on traite l'info
			$prod = $_POST['estProducteur'];
			$estprod = false;
			if ($prod == 'prod') {
				$estprod = true;
				$dateProducteur = date("Y-m-d H:i:s");
			}
		}
		/*		var_dump($dateProducteur);
                var_dump($_POST['idAdherent']);
                var_dump($mailPersonne);
                var_dump($_POST['PW_Adherent']);
                var_dump($_POST['adressepostaleAdherent']);
                var_dump($_POST['estProducteur']);
                var_dump($dateProducteur);
                var_dump(date("d M Y\, H:i:s"));*/


		//////////////////////////////
		//Traitement de l'adherent///
		////////////////////////////

		//on recupere les données dans des variables
		$idAdherent = $_POST['idAdherent'];
		$adressepostaleAdherent = $_POST['adressepostaleAdherent'];
		$PW_Adherent = Security::chiffrer($_POST['PW_Adherent']);
		$date = date("Y-m-d H:i:s");
		$nonce = Security::generateRandomHex();


		//on met toutes les données dans un tableau
		$arrayadh = [
			'idAdherent' => $idAdherent,
			'adressepostaleAdherent' => $adressepostaleAdherent,
			'ville' => $_POST['ville'],
			'PW_Adherent' => $PW_Adherent,
			'mailPersonne' => $mailPersonne,
			'estProducteur' => 0,
			'estAdministrateur' => 0,
			'dateinscription' => $date,
			'dateproducteur' => null,
			'nonce' => $nonce,
		];

		//on enregistre dans la bdd

		ModelAdherent::save($arrayadh);

		////////////////////////////////////////////////////
		/// On envoie un mail pour valider l'adresse //////
		//////////////////////////////////////////////////
		$a = ModelAdherent::select($idAdherent);
		$email = $a->get('mailPersonne');
		$p = ModelPersonne::select($email);
		$nom = $p->get('nomPersonne');
		$prenom = $p->get('prenomPersonne');
		$idurl = urlencode($idAdherent);
		$nonceurl = urlencode($nonce);

		$mail = new PHPMailer(TRUE);

		/* Open the try/catch block. */
		try {
			/* Set the mail sender. */
			$mail->setFrom('AMAP-Occitanie@no-reply.com', 'AMAP Occitanie');

			/* Add a recipient. */
			$mail->addAddress($email, "$prenom $nom");


			/* Set the subject. */
			$mail->Subject = "Validation de votre adresse mail";

			/* Set the mail message body. */
			$mail->isHTML(TRUE);
			$mail->Body = "<html>Bonjour, pour valider votre adresse mail veuillez cliquez <a href=\"http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedMail&controller=adherent&id=$idurl&nonce=$nonceurl\">ici</a></html>";
			$mail->AltBody = "Bonjour, pour valider votre adresse mail veuillez copier coller ce lien http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedMail&controller=adherent&id=$idurl&nonce=$nonceurl";
			/* Finally send the mail. */
			$mail->send();
		}
		catch (Exception $e)
		{
			/* PHPMailer exception. */
			echo $e->errorMessage();
		}
		catch (\Exception $e)
		{
			/* PHP exception (note the backslash to select the global namespace Exception class). */
			echo $e->getMessage();
		}


		//on redirige vers l'accueil ou vers le formulaire pour les producteurs s'il a coché est producteur
		if(!$estprod)
			return ControllerAccueil::homepage();
		return self::becomeprod($idAdherent);
	}

	public static function validatedMail()
	{
		//on vérifie qu'on a bien les infos
		if(!isset($_GET['id'])||!isset($_GET['nonce'])) {
			return self::error();
		}

		//on les récupère dans des variables
		$id = $_GET['id'];
		$nonce = urldecode($_GET['nonce']);
		$c = ModelAdherent::select($id);

		//on vérifie que l'id est valide
		if (!$c) {
			return self::error();
		}

		//on vérifie que le nonce est valide
		if ($c->get('nonce') != $nonce) {
			return self::error;
		}

		//on update
		$array = array(
			'idAdherent' => $id,
			'nonce' => null,
		);
		ModelAdherent::update($array);
		$_POST['phrase'] = 'Votre adresse email a bien été validée.';
		ControllerAdherent::connect();

	}

	/**
	 *	Fait passer un adhérent à producteur
	 *
	 *	@param l'idAdherent $idAdherent qui peut etre null
	 *
	 */
	public static function becomeprod($idAdherent = null)
	{
		if (is_null($idAdherent) && isset($_SESSION['login']))
			$id = $_SESSION['login'];
		else
			$id = $idAdherent;
		$view = 'formprod';
		$pagetitle = 'Finalisation de l\'inscription';
		require File::build_path(array('view','view.php'));
	}

	public static function newprod()
	{
		//on vérifie qu'on a recu les données
		if (!isset($_POST['description']) || !isset($_POST['id']))
			return self::error();

		//on vérifie que l'image est uploadée
		if (empty($_FILES['nom-image']) || !is_uploaded_file($_FILES['nom-image']['tmp_name']))
			return self::error();

		//on recupere le nom du fichier
		$name = $_FILES['nom-image']['name'];
		$pic_path = File::build_path(array('images', $name));
		$allowed_ext = array("jpg", "jpeg", "png");

		$realextarray = explode('.', $_FILES['nom-image']['name']);

		//on test l'extension du fichier upload
		if (!in_array(end($realextarray), $allowed_ext))
			return self::error();

		//on essaie de le déplacer et on retourne une erreur si ca plante
		if (!move_uploaded_file($_FILES['nom-image']['tmp_name'], $pic_path))
			return self::error();

		$path = File::build_path(array('images', $name));

		//on test que le fichier upload existe au bon endroit
		if (!file_exists($path))
			return self::error();

		//on recupere les infos du form
		$description = $_POST['description'];
		$id = $_POST['id'];
		$dateprod = date("Y-m-d H:i:s");

		$arrayupd = [
			'idAdherent' => trim($id),
			'description' => $description,
			'photo' => null,//$name,
			'isValid' => 0,
			'dateProducteur' => $dateprod,
		];

		///////////////////////////////////////
		/// On envoie un mail aux admin //////
		/////////////////////////////////////
		$a = ModelAdherent::select($id);
		$email = $a->get('mailPersonne');
		$p = ModelPersonne::select($email);
		$nom = $p->get('nomPersonne');
		$prenom = $p->get('prenomPersonne');
		$toValid = Model::countTotalToValid();
		$idurl = urlencode($id);

		$mail = new PHPMailer(TRUE);

		/* Open the try/catch block. */
		try {
			/* Set the mail sender. */
			$mail->setFrom('AMAP-Occitanie@no-reply.com', 'AMAP Occitanie');

			/* Add a recipient. */
			foreach (ModelAdherent::getMailAdmin() as $email) {
				$prenomAdmin = ModelPersonne::select($email['0'])->get('prenomPersonne');
				$nomAdmin = ModelPersonne::select($email['0'])->get('nomPersonne');
				$mail->addAddress($email['0'], "$prenomAdmin $nomAdmin");
			}

			/* Set the subject. */
			$mail->Subject = "$prenom $nom voudrait devenir producteur";

			/* Set the mail message body. */
			$mail->isHTML(TRUE);
			$mail->Body = "<html>Bonjour, pour valider le nouveau producteur veuillez vous connecter en tant qu'administrateur puis, veuillez cliquez <a href=\"http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedOne&controller=admin&type=adherent&id=$idurl\">ici</a>, pour voir toutes les validations en attente veuillez cliquer <a href=\"http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validate&controller=admin\">ici</a>, il y a actuellement $toValid demandes a valider.</html>";
			$mail->AltBody = "Bonjour, pour valider le nouveau producteur, veuillez copier coller ce lien dans la barre de navigation http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validatedOne&controller=admin&type=adherent&id=$idurl, pour voir toutes les validations en attente veuillez copier coller ce lien dans la barre de navigation http://webinfo.iutmontp.univ-montp2.fr/~sambucd/monAMAP/?action=validate&controller=admin , il y a actuellement $toValid demandes a valider.";

			/* Finally send the mail. */
			$mail->send();
		}
		catch (Exception $e)
		{
			/* PHPMailer exception. */
			echo $e->errorMessage();
		}
		catch (\Exception $e)
		{
			/* PHP exception (note the backslash to select the global namespace Exception class). */
			echo $e->getMessage();
		}

		//on update la personne
		ModelAdherent::update($arrayupd);
		return ControllerAccueil::homepage();
	}

	/**
	 * Redirige vers la page de connection
	 */
	public static function connect()
	{
		//redirection vers le formulaire de connexion
		if (!isset($phrase)) {
			if (isset($_POST['phrase'])) {
				$phrase = $_POST['phrase'];
			} else {
				$phrase = "";
			}
		}
		$view = 'connect';
		$pagetitle = 'Se connecter';
		require File::build_path(array('view','view.php'));
	}

	/**
	 * Connecte la personne si elle a tapé les bons identifiants
	 * Initialise les variables de session
	 */
	public static function connected()
	{
		//(1) si l'utilisateur n'est pas connecté, alors il peut se connection.
		if (!isset($_SESSION['login'])){

			//(2) si l'utilisateur rempli les champs "login" et "mot de passe"
			if (isset($_POST['idAdherent'])&&isset($_POST['pw']))
			{
				
				
				//var_dump($adh->get('estProducteur'));
				$login = $_POST['idAdherent'];

				//on chiffre le mot de passe saisi pour le comparer à celui dans la base de donnée
				$pw = Security::chiffrer($_POST['pw']);

				//(3)si l'idAdherent existe dans la base de donnée
				if ($adh=ModelAdherent::select($login))
				{
					if (!is_null($adh->get('nonce')))
					{
						return self::error();
					}

					//(4) si les deux mots de passes correspondent
					if (ModelAdherent::select($login)->checkPW($login, $pw))
					{

						//si il est admin
						if($adh->get('estAdministrateur') == '1'){
							$_SESSION['administrateur'] = 1;
						}
						//si il est prod
						if($adh->get('estProducteur') == '1'){
							$_SESSION['producteur'] = 1;
						}

						$_SESSION['login'] = $login;
						$a = ModelAdherent::select($login);
						ControllerMonProfil::profile();

					}

					//(4) sinon il ne peut pas se connecter
					else {
						$view = 'connectErreur';
						$pagetitle = 'Se connecter';
						$errmsg = "Mot de passe incorrect";
						require File::build_path(array('view','view.php'));
					}
				}

				//(3) sinon il ne peut pas se connecter
				else {
					$view = 'connectErreur';
					$pagetitle = 'Se connecter';
					$errmsg = " Login incorrect ";
					require File::build_path(array('view','view.php'));
				}
			}
			//(2) sinon il ne peut pas de connecter
			else {
				$view = 'connectErreur';
				$pagetitle = 'Se connecter';
				$errmsg = " Veuillez vous connecter ";
				require File::build_path(array('view','view.php'));
			}
		}
		//(1) sinon, comme il est déjà connecté, il ne peut pas se connecter 
		else {
			self::error();
		}
	}

	/**
	 * Deconnecte la personne si elle été connectée redirige vers une erreur sinon
	 */
	public static function deconnect()
	{
		session_unset();
		ControllerAccueil::homepage();
	}


	/**
	 * Redirige vers une page d'erreur
	 */
	public static function error()
	{
		$view = 'error';
		$pagetitle = 'Error 404';
		require File::build_path(array('view','view.php'));
	}
}
?>
