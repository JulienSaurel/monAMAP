        <?php
        foreach ($tab_pers as $p) //pour chaque personne dans la base de données
        {
            $idPersonne = htmlspecialchars($p->get('idPersonne')); 
            //on récupère l'id de la personne pour le preciser sur la page et on echappe les caracteres dangereux pour le html

            $idPersUrl = rawurlencode($p->get('idPersonne'));
            //on récupère l'id de la personne pour le preciser dans l'url et on echappe les caracteres dangereux pour le php
            
            //var_dump($idPersonne);
            
            echo "<p> Personne d'id:  <a href=\"?action=read&controller=$controller&idPersonne={$idPersonne}\"> $idPersonne </a> . </p>";
        //on affiche l'id personne avec un lien vers ses détails
        }
