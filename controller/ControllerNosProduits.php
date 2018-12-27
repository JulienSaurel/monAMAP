<?php 

require_once File::build_path(array('model','ModelProduit.php'));
require_once File::build_path(array('model','Model.php'));

class ControllerNosProduits
{
    protected static $object='nosProduits';

public static function readAll(){
       $tab_prod=ModelAdherent::readAllProd();
       return $tab_prod;
/*      $view = 'nosproducteurs';
        $pagetitle = 'Nos Producteurs';
        require File::build_path(array('view','view.php')); */
    }

     public static function display()
    {
        $tab = ModelProduit::getAllProduit();
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
        $tab_prod = self::readAll();
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


} 
?>











