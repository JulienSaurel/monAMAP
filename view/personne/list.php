<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des personnes</title>
    </head>
    <body>
        <?php
        foreach ($tab_pers as $p) //pour chaque personne dans la base de données
        {
            $idPersonne = $p->get('idPersonne'); //on récupère l'id de la personne pour le preciser sur la page
            echo "<p> Personne d'id:  <a href=\"http://localhost/Mon%20AMAP/controller/routeur.php?actionP=read&idPersonne={$idPersonne}\"> $idPersonne </a> . </p>";
        //on affiche l'id personne avec un lien vers ses détails
        }
        ?>
    </body>
</html>

