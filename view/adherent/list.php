<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des Adherents</title>
    </head>
    <body>
        <?php
        foreach ($tab_pers as $p) 
        {
            $idAdherent = $p->get('idAdherent');
            echo "<p> Adherent d'id:  <a href=\"http://localhost/Mon%20AMAP/controller/routeur.php?action=read&idAdherent={$idAdherent}\"> $idAdherent </a> . </p>";
        }
        ?>
    </body>
</html>

