<?php 

class ControllerNosProduits
{
    protected static $object='nosProduits';

    public static function readAllProd(){
        $sql = "SELECT * FROM Adherent A WHERE A.estProducteur=:prod";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "prod" => '1');
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdherent');
        return $req_prep->fetchAll();
        
    }

	public static function display()
	{
		$controller ='nosProduits';
        $view = 'produits';
        $pagetitle = 'Nos Produits';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {
        $tab_prod = self::readAllProd();
        $controller ='nosProduits';
        $view = 'nosproducteurs';
        $pagetitle = 'Nos Producteurs';
        require File::build_path(array('view','view.php'));    
    }

    public static function display2nd()
    {
        $controller ='nosProduits';
        $view = 'produitsdumoment';
        $pagetitle = 'Produits du moment';
        require File::build_path(array('view','view.php')); 
    }

	 public static function error()
    {
    $controller ='nosProduits';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }


} 
?>