<?php 

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
        $view = 'produits';
        $pagetitle = 'Nos Produits';
        require File::build_path(array('view','view.php')); 
    }

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











