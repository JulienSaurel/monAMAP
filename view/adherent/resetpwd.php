<form method="post" action="?action=resetpwd&controller=adherent&id=<?php echo $idUrl;?>">
    <fieldset>
        <legend>Modification de votre mot de passe:</legend>
        <p><label for="pw1">Nouveau mot de passe:</label><input type="password" name="pw1" id="pw1"></p>
        <p><label for="pw2">Confirmation du nouveau mot de passe:</label><input type="password" name="pw2" id="pw2"></p>
        <input type="submit" value="Modifier mon mot de passe">
    </fieldset>
</form>