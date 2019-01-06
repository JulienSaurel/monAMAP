<?php 
require_once File::build_path(array('model','ModelArticle.php')); // chargement du modèle
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle
require_once File::build_path(array('model','Model.php')); // chargement du modèle
require_once File::build_path(array('model','ModelHomepage.php'));

class ControllerAccueil
{
    protected static $object='accueil';

	public static function homepage()
	{
        $homepage = ModelHomepage::select('Accueil');
        $idHomepage = $homepage->get('idHompage');
        $pagetitlehp = $homepage->get('pagetitle');
        $welcomephrase = $homepage->get('welcomephrase');
        $descbannerphrase = $homepage->get('descbannerphrase');
        $newsnameandtext = $homepage->get('newsnameandtext');
        $namearticlelink = $homepage->get('namearticlelink');
        $firstarticledisplayed = $homepage->get('firstarticledisplayed');
        $secondarticledisplayed = $homepage->get('secondarticledisplayed');
        $firstparagraph = $homepage->get('firstparagraph');
        $maptitle = $homepage->get('maptitle');
        $firstimagetitle = $homepage->get('firstimagetitle');
        $firstimage = $homepage->get('firstimage');
        $firstimagephrase = $homepage->get('firstimagephrase');
        $secondimagetitle = $homepage->get('secondimagetitle');
        $secondimage = $homepage->get('secondimage');
        $secondimageparagraph = $homepage->get('secondimageparagraph');
        $firstparagraphlink = $homepage->get('firstparagraphlink');
        $firstimagelist = $homepage->get('firstimagelist');
        $maplink = $homepage->get('maplink');
        $banner = $homepage->get('banner');

        $firstarticle = ModelArticle::select($firstarticledisplayed);
        $firstarticlephoto = $firstarticle->get('photo');
        $firstarticlename = $firstarticle->get('titreArticle');

        $secondarticle = ModelArticle::select($secondarticledisplayed);
        $secondarticlephoto = $secondarticle->get('photo');
        $secondarticlename = $secondarticle->get('titreArticle');

        $tabbanner = explode(" ", $banner);
        $list = explode(PHP_EOL , $firstimagelist);
        $newstab = explode(PHP_EOL, $newsnameandtext);


		//redirection vers la page d'accueil
        if (!isset($phrase)) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
        }
        $controller ='accueil';
        $view = 'accueil';
        $pagetitle = 'Accueil';
        require File::build_path(array('view','view.php')); 
	}

    //page d'erreur
	 public static function error()
    {
    $controller ='accueil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('accueil','accueil.php'));
    }
}
?>


