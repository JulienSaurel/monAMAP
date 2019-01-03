<?php

require_once File::build_path(array('model','Model.php'));

class ModelProduit extends Model 
{


    protected $nomProduit;
    protected $photo;
    protected $description;
    protected $idAdherent;
    protected $categorie;
    static protected $object = 'produit';
    protected static $primary='nomProduit';

}



?>
