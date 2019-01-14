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
        
        $totalDesMessages = self::countAllValid();
        $nombreDePages = ceil($totalDesMessages / self::$nbmessagepage);
        //var_dump($nombreDePages);
        
        return $nombreDePages;
    }

    public static function getAllBetween($offset, $nbmsg)
    {     
        $sql = 'SELECT * FROM LivreDor WHERE isValid = 1 ORDER BY id_message DESC LIMIT ' . $nbmsg . ' OFFSET ' . $offset;
        

        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();
        
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelLivreDor');
        

        $tab = $req_prep->fetchAll();
        return $tab;
    }

    public function isValid()
    {
        if ($this->get('isValid') == true)
            return true;
        return false;
    }
}
?>