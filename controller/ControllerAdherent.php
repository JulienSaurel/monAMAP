<?php
require_once File::build_path(array('model','ModelAdherent.php'));
require_once File::build_path(array('model','ModelPersonne.php'));
require_once File::build_path(array('controller','ControllerMonProfil.php'));


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

	public static function create()
	{

		$view = 'create';
		$pagetitle = 'S\'inscrire';
		require File::build_path(array('view','view.php'));
	}

	public static function created()
	{

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
		$dateProducteur = null;
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
		/*			var_dump($dateProducteur);
                    var_dump($_POST['idAdherent']);
                    var_dump($idPersonne);
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

		//on met toutes les données dans un tableau
		$arrayadh = [
			'idAdherent' => $idAdherent,
			'adressepostaleAdherent' => $adressepostaleAdherent,
			'ville' => $_POST['ville'],
			'PW_Adherent' => $PW_Adherent,
			'mailPersonne' => $mailPersonne,
			'estProducteur' => $estprod,
			'estAdministrateur' => false,
			'dateinscription' => $date,
			'dateproducteur' => $dateProducteur,
		];

		//on enregistre dans la bdd
		ModelAdherent::save($arrayadh);

		//on redirige vers l'accueil ou vers le formulaire pour les producteurs s'il a coché est producteur
		if(!$estprod)
			return ControllerAccueil::homepage();
		return self::becomeprod($idAdherent);
	}

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
		$pic_path = __DIR__ . '/' . ".." . "/images/$name";
		$allowed_ext = array("jpg", "jpeg", "png");

		$realextarray = explode('.', $_FILES['nom-image']['name']);

		//on test l'extension du fichier upload
		if (!in_array(end($realextarray), $allowed_ext))
			return self::error();

		//on essaie de le déplacer et on retourne une erreur si ca plante
		if (!move_uploaded_file($_FILES['nom-image']['tmp_name'], $pic_path))
			return self::error();

		$path = File::build_path(array('images', $name));

		if (!file_exists($path))
			return self::error();

		$description = $_POST['description'];

			$arrayupd = [
				'idAdherent' => $_POST['id'],
				'description' => $description,
				'photo' => $name,
				];

			ModelAdherent::update($arrayupd);

			var_dump(ModelAdherent::select($_POST['id']));
		return ControllerAccueil::homepage();
	}

	public static function error()
	{
		$view = 'error';
		$pagetitle = 'Error 404';
		require File::build_path(array('view','view.php'));
	}


	public static function connect()
	{
		$view = 'connect';
		$pagetitle = 'Se connecter';
		require File::build_path(array('view','view.php'));
	}

	public static function connected()
	{
		if (isset($_POST['idAdherent'])&&isset($_POST['pw']))
		{
			$login = $_POST['idAdherent'];
			$pw = Security::chiffrer($_POST['pw']);
			if (ModelAdherent::select($_POST['idAdherent']))
			{
				if (ModelAdherent::select($login)->checkPW($login, $pw))
				{

					$_SESSION['login'] = $login;
					$a = ModelAdherent::select($login);
					ControllerMonProfil::profile();
				} else {
					$view = 'connectErreur';
					$pagetitle = 'Se connecter';
					$errmsg = "Mot de passe incorrect";
					require File::build_path(array('view','view.php'));
				}
			} else {
				$view = 'connectErreur';
				$pagetitle = 'Se connecter';
				$errmsg = " Login incorrect ";
				require File::build_path(array('view','view.php'));
			}
		} else {
			$view = 'connectErreur';
			$pagetitle = 'Se connecter';
			$errmsg = " Veuillez vous connecter ";
			require File::build_path(array('view','view.php'));
		}


	}

	public static function deconnect()
	{
		session_unset();

		ControllerAccueil::homepage();
	}
}
?>
