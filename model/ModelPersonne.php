<?php

require_once File::build_path(array('model','Model.php'));

class ModelPersonne extends Model 
{

    protected $nomPersonne;
    protected $prenomPersonne;
    protected $mailPersonne;
    static protected $object = 'personne';
    protected static $primary='mailPersonne';

}
?>