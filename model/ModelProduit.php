<?php

require_once File::build_path(array('model','Model.php'));

class ModelProduit extends Model 
{

    protected $nomProduit;
    protected $image;
    protected $description;

    static protected $object = 'produit';
    protected static $primary='nomProduit';

    public static function readAllProduits(){
		$SQL_request = " SELECT * FROM Produit ";
		$rep = Model::$pdo->query($SQL_request);
		$rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
		$tab_a = $rep->fetchAll();
		return $tab_a;
        
    }
}
?>
