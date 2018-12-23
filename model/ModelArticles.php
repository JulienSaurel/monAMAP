<?php

require_once File::build_path(array('model','Model.php'));

class ModelArticles extends Model 
{

    protected $idArticle;
    protected $titreArticle;
    protected $photo;
    protected $date;
    protected $description;
    protected $idAdherent;
    static protected $object = 'article';
    protected static $primary='idArticle';

   
}
 ?>