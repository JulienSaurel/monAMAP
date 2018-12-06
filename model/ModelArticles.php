<?php

require_once File::build_path(array('model','Model.php'));

class ModelArticles extends Model 
{

    private $idArticle;
    private $titreArticle;
    private $photo;
    private $date;
    private $description;
    private $idAdherent;
    static protected $object = 'article';
    protected static $primary='idArticle';

   
}
 ?>