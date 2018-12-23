<?php

require_once File::build_path(array('model','Model.php'));

class ModelDonnateur extends Model
{

    protected $mailAddressDonnateur;
    protected $nomDonnateur;
    protected $prenomDonnateur;
    protected $montantTotal;
    static protected $object = 'donnateur';
    protected static $primary='mailAddressDonnateur';

}
?>