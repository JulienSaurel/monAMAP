<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Personne</title>
    </head>
    <body>
        <?php
     echo "{$p->get('idPersonne')}: {$p->get('prenomPersonne')} {$p->get('nomPersonne')} \n mail: {$p->get('mailPersonne')} " //on affiche les informations de la personne en utilisant les getter generiques
        ?>
    </body>
</html>

