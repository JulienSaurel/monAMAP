<?php
class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function isAdmin()
    {
        //Si la personne n'est pas connectée on declare une erreur
        if (!isset($_SESSION['login'])) {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            return ControllerAdherent::connect();
        }

        //Si la personne n'est pas admin on declare une erreur
        if (!isset($_SESSION['administrateur'])) {
            $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
            return ControllerAccueil::homepage();
        }

        return true;
    }
}
?>