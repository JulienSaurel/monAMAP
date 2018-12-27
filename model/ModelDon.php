<?php

require_once File::build_path(array('model','Model.php'));

class ModelDon extends Model
{

    protected $idDon;
    protected $montantDon;
    protected $mailAddressDonnateur;
    static protected $object = 'don';
    protected static $primary='idDon';

    public static function getLastDonFrom($mail)
    {
        $sql="SELECT * FROM Don WHERE mailAddressDonnateur=:tag AND idDon = (SELECT MAX(idDon) FROM Don WHERE mailAddressDonnateur=:tag )";

        $req_prep = Model::$pdo->prepare($sql);

        $valeur = array(
            "tag" => $mail);

        $req_prep->execute($valeur);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDon');
        $tab_don = $req_prep->fetchAll();

        return $tab_don[0];
    }

}
?>