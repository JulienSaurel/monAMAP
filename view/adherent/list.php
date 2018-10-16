<?php   foreach ($tab_adh as $p) //pour chaque adherent dans la base de données
        {
            $idAdherent = htmlspecialchars($p->get('idAdherent')); 
            //on récupère l'id de l'adherent pour le preciser sur la page et on echappe les caracteres dangereux pour l'html
            
            $idPersUrl = rawurlencode($p->get('idAdherent'));
            //on récupère l'id de l'adherent pour le preciser dans l'url et on echappe les caracteres dangereux pour le php
            
            echo "<p> Adherent d'id:  <a href=\"?actionA=read&idAdherent={$idAdherent}\"> $idAdherent </a> . </p>"; 
            //on affiche l'id adherent avec un lien vers ses détails
        }