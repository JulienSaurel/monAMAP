<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Personne</title>
    </head>
    <body>
        <?php
     echo "Identifiant: {$a->get('idAdherent')}" . $a->get('idPersonne').toString() . " adresse: {$a->get('adressepostaleAdherent')}" //On affiche les details de l'adherent en utilisant les getters generiques et la methode toString de la classe ModelPersonne
        ?>
    </body>
</html>

