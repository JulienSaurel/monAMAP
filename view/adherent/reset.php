<form method="post" action="?action=reset&controller=adherent&type=<?php echo $type;?>">
    <fieldset>
        <legend><?php echo $formtitle;?></legend>
        <p><label for="pseudo">Pseudo:</label>
        <input type="text" name="idAdherent" id="pseudo"></p>
        <p><input type="submit" value="Envoyer"></p>
    </fieldset>
</form>
<p>Un mail vous sera envoyé avec un lien pour <?php echo $text;?> </p>