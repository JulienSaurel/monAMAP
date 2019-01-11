<?php

require_once File::build_path(array('model','Model.php'));

class ModelArticle extends Model
{

    protected $idArticle;
    protected $titreArticle;
    protected $photo;
    protected $date;
    protected $description;
    protected $mailPersonne;
   
    static protected $object = 'article';
    protected static $primary='idArticle';

    // public function __construct($t = NULL, $p = NULL,  $des = NULL, $idAdh = NULL) {
    //     if (!is_null($t) && !is_null($p) && !is_null($des) && !is_null($idAdh)) {
    //         $this->titreArticle = $t;
    //         $this->photo = $p;
    //         $this->date = date("Y-m-d H:i:s");
    //         $this->description = $des;
    //         $this->mailPersonne = $idAdh;
    //     }
    // }

    public function saveArt(){
          $sql = "INSERT INTO Article(titreArticle, photo, description, mailPersonne) VALUES (:t, :p, :des, :idAdh)";
        // Préparation de la requête
          $req_prep = Model::$pdo->prepare($sql);

          $values = array(
              "t" => $this->titreArticle,
              "p" => $this->photo,
              "des" => $this->description,
              "idAdh" => $this->mailPersonne,
          );
          // On donne les valeurs et on exécute la requête
          $req_prep->execute($values);
    }

    public static function selectAllTri(){
      $SQL_request = " SELECT * FROM Article WHERE isValid <> 0 ORDER BY date DESC";
        $rep = Model::$pdo->query($SQL_request);
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelArticle');
        $tab_a = $rep->fetchAll();
        // $p = $tab_a[0];
        // $d = $tab_a[1];
        // $values = array(
        //   "$values[0]" => $p,
        //   "values[1]" => $d,
        // )
        return $tab_a;
    }

    public function isValid()
    {
        if ($this->get('isValid') == true)
            return true;
        return false;
    }
}
 ?>