<?php

require_once File::build_path(array('model','Model.php'));

class ModelArticles extends Model 
{

    protected $idArticle;
    protected $titreArticle;
    protected $photo;
    protected $date;
    protected $description;
    protected $idPersonne;
   
    static protected $object = 'article';
    protected static $primary='idArticle';

    // public function __construct($t = NULL, $p = NULL,  $des = NULL, $idAdh = NULL) {
    //     if (!is_null($t) && !is_null($p) && !is_null($des) && !is_null($idAdh)) {
    //         $this->titreArticle = $t;
    //         $this->photo = $p;
    //         $this->date = date("Y-m-d H:i:s");
    //         $this->description = $des;
    //         $this->idPersonne = $idAdh;
    //     }
    // }

    public function saveArt(){
          $sql = "INSERT INTO Article(titreArticle, photo, description, idPersonne) VALUES (:t, :p, :des, :idAdh)";
        // Préparation de la requête
          $req_prep = Model::$pdo->prepare($sql);

          $values = array(
              "t" => $this->titreArticle,
              "p" => $this->photo,
              "des" => $this->description,
              "idAdh" => $this->idPersonne,
          );
          // On donne les valeurs et on exécute la requête
          $req_prep->execute($values);
    }
}
 ?>