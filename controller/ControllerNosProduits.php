<?php 

require_once File::build_path(array('model','ModelProduit.php'));
require_once File::build_path(array('model','Model.php'));
require_once File::build_path(array('model','ModelAdherent.php')); // chargement du modèle

class ControllerNosProduits
{
    protected static $object='nosProduits';

// public static function readAll(){
//        $tab_prod = ModelAdherent::readAllProd();
//        return $tab_prod;
//       $view = 'nosproducteurs';
//         $pagetitle = 'Nos Producteurs';
//         require File::build_path(array('view','view.php')); 
//     }


     public static function display()
    {

        $tab = ModelProduit::selectAll();
        $view = 'produits';
        $pagetitle = 'nos produits';
        require File::build_path(array('view','view.php'));
    }



    /*public static function display()
    {   
        $view = 'produits';
        $pagetitle = 'Nos Produits';
        require File::build_path(array('view','view.php')); 
         $tab_produit = ModelProduit::getAllProduit();
       return $tab_produit;
    }
*/

    public static function display1st()
    {
        $tab_prod = ModelAdherent::readAllProd();
        $view = 'nosproducteurs';
        $pagetitle = 'Nos Producteurs';
        require File::build_path(array('view','view.php'));    
    }

    public static function display2nd()
    {
        $view = 'produitsdumoment';
        $pagetitle = 'Produits du moment';
        require File::build_path(array('view','view.php')); 
    }

     public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    } 

////////////**********Ajout d'un article**********////////////

//redirige vers le formulaire d'ajout de produit
    public static function createProd(){
        if (isset($_SESSION['producteur'])){
            $view = 'createProd';
            $pagetitle = 'Ajoutez un article';
            require File::build_path(array('view','view.php'));
        } else {
            self::error();
        }
    }

//action de création de produit
    public static function createdProd(){
        if (isset($_SESSION['producteur'])){
            //$a = ModelAdherent::select($_SESSION['login']);
            //$mailPersonne = $a->get('mailPersonne');

            //on met toutes les données dans un tableau
            $data = [
                'nomProduit' => $_POST['titre'],
                'image' => $_POST['image'],
                'description' => $_POST['description'],
            ];

            //on enregistre les données dans la bd
            ModelProduit::save($data);
            
            //redirection vers les articles
            self::display();
        } else {
            self::error();
        }   
    }

} 
?>











