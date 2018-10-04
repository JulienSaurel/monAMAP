<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Personne</title>
    </head>
    <body>
        <?php
     echo "{$p->get('idPersonne')}: {$p->get('prenomPersonne')} {$p->get('nomPersonne')} \n mail: {$p->get('mailPersonne')} "
        ?>
    </body>
</html>

