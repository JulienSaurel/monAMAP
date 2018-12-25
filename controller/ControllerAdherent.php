<?php
require_once File::build_path(array('model','ModelAdherent.php'));// chargement du modèle
require_once File::build_path(array('model','ModelPersonne.php'));// chargement du modèle
require_once File::build_path(array('controller','ControllerMonProfil.php'));// chargement du modèle
require_once File::build_path(array('controller','ControllerAdmin.php'));// chargement du modèle


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

	//page d'inscription
	public static function create()
	{
		//redirection vers le formulaire d'inscription
		$view = 'create';
		$pagetitle = 'S\'inscrire';
		require File::build_path(array('view','view.php'));
	}

	//action d'inscription
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
			$estprod = 0;
			if ($prod == 'prod') {
				$estprod = 1;
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
			'estAdministrateur' => 0,
			'dateinscription' => $date,
			'dateproducteur' => $dateProducteur,
		];

		//on enregistre dans la bdd
		ModelAdherent::save($arrayadh);

		//on redirige vers l'accueil
		return ControllerAccueil::homepage();

	}

	//page de connexion
	public static function connect()
	{
		//redirection vers le formulaire de connexion
		$view = 'connect';
		$pagetitle = 'Se connecter';
		require File::build_path(array('view','view.php'));
	}

	public static function connected()
	{
		//(1) si l'utilisateur n'est pas connecté, alors il peut se connection.
		if (!isset($_SESSION['login'])){

			//(2) si l'utilisateur rempli les champs "login" et "mot de passe"
			if (isset($_POST['idAdherent'])&&isset($_POST['pw']))
			{
				//on récupère les données de celui qui veut se connecter, grâce à son login (=idAdherent)
				$informations=ModelAdherent::select($_POST['idAdherent']);
				//var_dump($informations->get('estProducteur'));
				$login = $_POST['idAdherent'];

				//on chiffre le mot de passe saisi pour le comparer à celui dans la base de donnée
				$pw = Security::chiffrer($_POST['pw']);
				
				//(3)si l'idAdherent existe dans la base de donnée
				if (ModelAdherent::select($_POST['idAdherent']))
				{

					//(4) si les deux mots de passes correspondent
					if (ModelAdherent::select($login)->checkPW($login, $pw))
					{

						//si il est admin
						if($informations->get('estAdministrateur') == '1'){
							$_SESSION['administrateur'] = 1;
						}
						//si il est prod
						if($informations->get('estProducteur') == '1'){
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

	//déconnexion
	public static function deconnect()
	{
		session_unset();
		ControllerAccueil::homepage();
	}


	//page d'erreur
	public static function error()
	{
		$view = 'error';
		$pagetitle = 'Error 404';
		require File::build_path(array('view','view.php'));
	}
}
?>
