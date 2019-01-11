<?php
require_once File::build_path(array('config','Conf.php'));
class Model {
    public static $pdo;

    public static function Init() {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
        }
    }

    //retourne la valeur d'un attribut du model sur lequel on l'appelle
    //si la propriété nom_attribut n'existe pas retourne false
    public function get($nom_attribut)
    {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    //si la propriété nom_attribut n'existe pas retourne false
    public function set($nom_attribut, $valeur)
    {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    //constructeur générique à partir d'un tableau des attributs de l'objet
    //si le tableau est null, ne fait rien
    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }


    static public function selectAll() {
        try{
            //on recupere les noms de tables/classes a partir des attributs statics declares dans chaque classe
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $sql = 'SELECT * FROM '.ucfirst($table_name);


            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);


            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
            return $tab;
    }

    static public function select($primary_value)
    {
        try {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $primary_key = static::$primary;

        $sql = "SELECT * from " . ucfirst($table_name) .  " WHERE " . $primary_key . " ='" . trim($primary_value). "'";

        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();

        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        if (empty($tab))
        {
            return false;
        }
        return $tab[0];
    }

    static public function delete($primary_value) {
        try{
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;
            $sql = "DELETE from " . ucfirst($table_name) .  " WHERE " . $primary_key . " = '" . $primary_value. "'";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();
            $count = $req_prep->rowCount();
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        if($count<1 || $count>1) {
            return false;
        } else {
            return true;
        }
    }

    static public function countAll()
    {
        try {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $sql = 'SELECT COUNT(*) FROM '.ucfirst($table_name);

        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();

        $tab = $req_prep->fetchColumn();
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        return (int)$tab;
    }

    //remplace les champs d'un objet par ceux contenus par $data
    public static function update($data)
    {
        try
        {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $sql = "UPDATE " . ucfirst($table_name) . " SET ";
            foreach ($data as $key => $value)
            {
                $sql .= $key . " =:" . $key . ', ';
            }
            $sql = rtrim($sql, ', ') . " WHERE " . $primary_key . " =:" . trim($primary_key);
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    //sauvegarde un objet dans la base de données à partir d'un tableau contenant tous ses attributs
    public static function save($data)
    {
        try
        {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $sql = "INSERT INTO " . ucfirst($table_name) . " (";
            foreach ($data as $key => $value)
            {
                $sql .= $key . ', ';
            }

            $sql = rtrim($sql, ', ') . ") VALUES (";
            foreach ($data as $key => $value)
            {
                $sql .= ":" . $key . ', ';
            }
            $sql = rtrim($sql, ', ') . ")";
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
        } catch(PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    //genere une id qui n'est pas presente dans la bdd
    public static function generateId()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;


            $sql = "SELECT MAX(" . $primary_key . ") FROM ". ucfirst($table_name);
            $req = Model::$pdo->query($sql);
            $res = $req->fetchColumn();

        }catch (PDOException $e) {
            if (Conf::getDebug())
            {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            else
            {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }

        if ($res)
            return $res+1;
        return 1;
    }

    //selectAll qui ne renvoie que les objets ayant isValid=false
    public static function selectAllToValid()
    {
        try{
            //on recupere les noms de tables/classes a partir des attributs statics declares dans chaque classe
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $sql = 'SELECT * FROM '.ucfirst($table_name) . " WHERE isValid = 0;";


            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);


            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        return $tab;

    }

    //selectAll qui ne renvoie que les objets ayant isValid=true
    public static function selectAllValid()

    {
        try{
            //on recupere les noms de tables/classes a partir des attributs statics declares dans chaque classe
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $sql = 'SELECT * FROM '.ucfirst($table_name) . " WHERE isValid <> 0;";


            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);


            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        return $tab;

    }

    //renvoie le nombre d'objets a valider dans le model appelé
    public static function countToValid()
    {
        try{
            //on recupere les noms de tables/classes a partir des attributs statics declares dans chaque classe
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $sql = 'SELECT COUNT(*) FROM '.ucfirst($table_name) . " WHERE isValid = 0;";


            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();

            $res = $req_prep->fetchColumn();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        return $res;
    }

    //renvoie le nombre d'objets valides dans le model appelé
    public static function countAllValid()
    {
        try{
            //on recupere les noms de tables/classes a partir des attributs statics declares dans chaque classe
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $sql = 'SELECT COUNT(*) FROM '.ucfirst($table_name) . " WHERE isValid <> 0;";


            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();

            $res = $req_prep->fetchColumn();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        return $res;
    }

    //renvoie le nombre total d'objets a valider
    public static function countTotalToValid()
    {
        return ModelLivreDor::countToValid() + ModelArticle::countToValid() + ModelAdherent::countToValid();
    }

    static public function selectAllIds() {
        try{
            //on recupere les noms de tables/classes a partir des attributs statics declares dans chaque classe
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $sql = 'SELECT '. $primary_key . ' FROM '.ucfirst($table_name);


            $req_prep = Model::$pdo->prepare($sql);

            $req_prep->execute();


            $tab = $req_prep->fetchAll();
        } catch(PDOException $e) { //on gere les exceptions
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        $tab = File::getNiceArray($tab);
        return $tab;
    }
}
Model::Init();
?>