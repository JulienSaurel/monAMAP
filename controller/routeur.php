<?php
require_once File::build_path(array('controller','ControllerPersonne.php'));
require_once File::build_path(array('controller','ControllerAdherent.php'));
require_once File::build_path(array('controller','ControllerAccueil.php'));
require_once File::build_path(array('controller','ControllerNousConnaitre.php'));
require_once File::build_path(array('controller','ControllerNousSoutenir.php'));
require_once File::build_path(array('controller','ControllerNosProduits.php'));
require_once File::build_path(array('controller','ControllerNosContrats.php'));
require_once File::build_path(array('controller','ControllerMonProfil.php'));
require_once File::build_path(array('controller','ControllerLaVieAlAMAP.php'));
require_once File::build_path(array('controller','ControllerAdmin.php'));


//------------controller-------------
if(!isset($_GET['controller'])) //Si le controller n'a  pas été spécifié
{
	return ControllerAccueil::homepage();
}

else
{
	$controller = $_GET['controller']; // On recupère le controller passée dans l'URL
}

$controller_class = 'Controller' . ucfirst($controller);
//on crée la variable qui represente la classe dur laquelle on appellera l'action

if (!file_exists(File::build_path(['controller',"$controller_class.php"]))) {
	$_POST['phrase'] = File::warning("URL Incorrecte, veuillez réessayer");
	return ControllerAccueil::homepage();
}

//--------------action---------------
if(!isset($_GET['action'])) //Si l'action n'a  pas été spécifiée
{
	$_POST['phrase'] = File::warning("URL Incorrecte, veuillez réessayer");
	return ControllerAccueil::homepage();
}

else
{
	if (in_array($_GET['action'], get_class_methods($controller_class)))
	{
		$action = $_GET['action']; // On recupère l'action passée dans l'URL
	}
	else
	{
		$_POST['phrase'] = File::warning("URL Incorrecte, veuillez réessayer");
		return ControllerAccueil::homepage();
	}

}
$controller_class::$action();
?>