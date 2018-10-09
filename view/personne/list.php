<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des personnes</title>
    </head>
    <body>
        <?php
        foreach ($tab_pers as $p) 
        {
            $idPersonne = $p->get('idPersonne');
            echo "<p> Personne d'id:  <a href=\"http://localhost/Mon%20AMAP/controller/routeur.php?actionP=read&idPersonne={$idPersonne}\"> $idPersonne </a> . </p>";
        }
        ?>
    </body>
</html>

