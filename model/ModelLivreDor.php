<?php

require_once File::build_path(array('model','Model.php'));

class ModelLivreDor extends Model
{

    protected $message;
    protected $id_message;
    protected $pseudo;
    protected static $nbmessagepage = 5;
    static protected $object = 'livreDor';
    protected static $primary='id_message';


    public static function getnbmsgpg()
    {
        return self::$nbmessagepage;
    }


    public static function getNbPages()
    {
        
        $totalDesMessages = self::countAll();
        $nombreDePages = ceil($totalDesMessages / self::$nbmessagepage);
        //var_dump($nombreDePages);
        
        return $nombreDePages;
    }

    public static function getAllBetween($deb, $fin)
    {     
        $sql = 'SELECT * FROM LivreDor ORDER BY id_message DESC LIMIT ' . $deb . ', ' . ($fin-$deb);
        

        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();
        
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelLivreDor');
        

        $tab = $req_prep->fetchAll();
        return $tab;
    }
}
?>