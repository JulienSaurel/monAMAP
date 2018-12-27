<?php

require_once File::build_path(array('model','Model.php'));

class ModelContrat extends Model 
{

    protected $idContrat;
    protected $idAdherent;
    protected $typeContrat;
    protected $tailleContrat;
    protected $frequenceContrat;
    static protected $object = 'contrat';
    protected static $primary='idContrat';

}
?>






