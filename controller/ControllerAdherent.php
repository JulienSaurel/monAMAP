<?php
	require_once File::build_path(array('model','ModelAdherent.php'));
	require_once File::build_path(array('model','ModelPersonne.php'));


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
			if($a)
			{
				$view = 'detail';
				$pagetitle = 'Personne';
				require File::build_path(array('view','view.php'));
				//"redirige" vers la vue qui affiche les details d'un adherent
			}
			else
			{
				$view = 'error';
				$pagetitle = 'Error 404 Not Found';
				require File::build_path(array('view','view.php'));
				//"redirige" vers la vue erreur.php qui affiche un msg d'erreur
			}
		}

		public static function create()
		{

			$view = 'create';
			$pagetitle = 'S\'inscrire';
			require File::build_path(array('view','view.php'));
		}

		public static function created()
		{
			if (isset($_POST['nomPersonne'])&& isset($_POST['prenomPersonne']) && isset($_POST['mailPersonne'])) {
				$p = new ModelPersonne($_POST['nomPersonne'], $_POST['prenomPersonne'], $_POST['mailPersonne']); //on recupere les infos du formulaire
                $p->save(); // on les sauve dans la base de donnees
				$idPersonne = $p->get('idPersonne');
			}
			else
			{
				$idPersonne = null;
				self::error();
			}
			$dateProducteur = null;
			if (isset($_POST['estProducteur'])) {
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

			if (isset($_POST['PW_Adherent'])&&isset($_POST['PW_Adherent2']))
			{
				if ($_POST['PW_Adherent'] == $_POST['PW_Adherent2']) {
					if (isset($_POST['idAdherent']) && isset($_POST['adressepostaleAdherent']) && isset($_POST['ville']) && isset($_POST['PW_Adherent'])) {
						//var_dump($_POST['ville']);
						$a = new ModelAdherent($_POST['idAdherent'], $_POST['adressepostaleAdherent'], $_POST['ville'], Security::chiffrer($_POST['PW_Adherent']), $idPersonne, $estprod, false, date("Y-m-d H:i:s"), $dateProducteur); //on recupere les infos du formulaires
						//
						//var_dump($a);
                        $a->save();// on les sauve dans la base de donnees
						$tab_adh = ModelAdherent::selectAll();
						$view='list';
						$pagetitle = 'Liste des adhérents';
						require File::build_path(array('view', 'view.php'));
					}
				}
			}
			else
			{
				self::error();
			}
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
				var_dump($_POST);
				var_dump($_SESSION);
				if (ModelAdherent::select($_POST['idAdherent']))
				{
					if (ModelAdherent::select($login)->checkPW($login, $pw))
					{	
						
						$_SESSION['login'] = $login;
						$a = ModelAdherent::select($login);
						$view = 'detail';
						$pagetitle = 'adhérent';
						
						require File::build_path(array('view','view.php'));
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
