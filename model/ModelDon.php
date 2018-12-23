<?php

require_once File::build_path(array('model','Model.php'));

class ModelDon extends Model
{

    protected $idDon;
    protected $montantDon;
    protected $mailAddressDonnateur;
    static protected $object = 'don';
    protected static $primary='idDon';

}
?>