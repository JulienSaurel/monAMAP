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

        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $sql = 'SELECT * FROM '.ucfirst($table_name);


        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();

        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);


        $tab = $req_prep->fetchAll();
        return $tab;
    }

    static public function select($primary_value)
    {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $primary_key = static::$primary;

        $sql = "SELECT * from " . ucfirst($table_name) .  " WHERE " . $primary_key . " = '" . $primary_value. "'";
        //var_dump($sql);
        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();

        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false

        if (empty($tab))
        {
            return false;
        }
        return $tab[0];
    }

    static public function delete($primary_value) {

        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $primary_key = static::$primary;
        $sql = "DELETE from " . ucfirst($table_name) .  " WHERE " . $primary_key . " = '" . $primary_value. "'";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();
    }

    static public function countAll()
    {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $sql = 'SELECT COUNT(*) FROM '.ucfirst($table_name);
        // var_dump($sql);
        $req_prep = Model::$pdo->prepare($sql);

        $req_prep->execute();

        $tab = $req_prep->fetchColumn();
        return (int)$tab;
    }

    //remplace les champs d'un objet par ceux contenus par $data
    // public static function update($data)
    // {
    //     try
    //     {
    //         $table_name = static::$object;
    //         $primary_key = static::$primary;

    //         $sql = "UPDATE " . ucfirst($table_name) . " SET ";
    //         foreach ($data as $key => $value)
    //         {
    //             $sql .= $key . " = :" . $key . ', ';
    //         }
    //         $sql = rtrim($sql, ', ') . " WHERE " . $primary_key . " = :" . $primary_key;
    //         $req_prep = Model::$pdo->prepare($sql);
    //         $req_prep->execute($data);
    //     } catch(PDOException $e) {
    //         if (Conf::getDebug())
    //         {
    //             echo $e->getMessage(); // affiche un message d'erreur
    //         }
    //         else
    //         {
    //             echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
    //         }
    //         die();
    //     }
    // }


        public static function update($primary_key, $primary_value, $table_name, $data)
        {
            try
            {
                //var_dump($data);
                $sql = "UPDATE " . $table_name . " SET ";
                foreach ($data as $valeur => $key)
                {
                    $sql = $sql . $valeur . " = '" . $key . "', ";

                }
                $sql = rtrim($sql, ', ') . " WHERE " . $primary_key . " = '" . $primary_value ."'";
                //var_dump($sql);
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
        error_reporting(E_ALL & ~E_NOTICE);
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
}
Model::Init();
?>
