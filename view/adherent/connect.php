<?php echo $phrase;?>
<form method="post" action="?action=connected&controller=adherent">


    <fieldset>
        <legend>Se connecter :</legend>
        <p>
            <label for="login_id">Login</label> :
            <input type="text" placeholder="Ex : 2" name="idAdherent" id="login_id" required/>
        </p>
        <p>
            <label for="pw_id">Password</label> :
            <input type="password" placeholder="Ex : Alizan" name="pw" id="pw_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>

    </fieldset>
    <p><a href="?action=create&controller=adherent">S'inscrire</a></p>
    <p><a href="?action=gotoreset&controller=adherent&type=pwd">Mot de passe oublié?</a></p>
    <p><a href="?action=gotoreset&controller=adherent&type=mail">Renvoyer le mail de validation</a></p>
</form>
