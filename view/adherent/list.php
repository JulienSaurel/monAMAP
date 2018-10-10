<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des Adherents</title>
    </head>
    <body>
        <?php
        foreach ($tab_adh as $p) //pour chaque adherent dans la base de données
        {
            $idAdherent = $p->get('idAdherent'); //on récupère l'id de l'adherent pour le preciser sur la page
            echo "<p> Adherent d'id:  <a href=\"http://localhost/Mon%20AMAP/controller/routeur.php?actionA=read&idAdherent={$idAdherent}\"> $idAdherent </a> . </p>"; //on affiche l'id adherent avec un lien vers ses détails
        }
        ?>
    </body>
</html>

