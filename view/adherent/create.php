<form method="post" action="?action=created&controller=adherent">
    <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->

    <fieldset>
        <legend>Formulaire d'inscription :</legend>
        <p>
            <label for="id_id">Pseudo :</label>
            <input type="text" placeholder="Ex : 2" name="idAdherent" id="id_id" required/>
        </p>
        <p>
            <label for="nom_id">Nom :</label>
            <input type="text" placeholder="Ex : Sambuc" name="nomPersonne" id="nom_id" required/>
        </p>
        <p>
            <label for="prenom_id">Prenom :</label>
            <input type="text" placeholder="Ex : David" name="prenomPersonne" id="prenom_id" required/>
        </p>
        <p>
            <label for="mail_id">Mail :</label>
            <input type="email" placeholder="Ex : dsambuc@free.fr" name="mailPersonne" id="mail_id" required/>
        </p>
        <p>
            <label for="addpost">adresse postale</label> :
            <input type="text" placeholder="Ex : 7, rue Marceau" name="adressepostaleAdherent" id="addpost" required/>
        </p>
        <input type="radio" name="estProducteur" value="prod"> Je suis producteur
        <input type="radio" name="estProducteur" value="nonprod"> Je ne suis pas producteur
        <p>
            <label for="pw1">Mot de passe</label> :
            <input type="password" placeholder="8 caractères minimum" name="PW_Adherent" id="pw1"  required/>
        </p>
        <p>
            <label for="pw2">Valider le mot de passe</label> :
            <input type="password" name="PW_Adherent2" id="pw2" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>