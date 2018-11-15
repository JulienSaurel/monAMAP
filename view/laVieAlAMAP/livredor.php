
<form method="post" action="TODO"> 
 <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->
  <fieldset>
    <legend>Mon site vous plaît? Laissez moi un message !</legend>
    <p>
      <label for="pseudo">Pseudo :</label> 
       <input type="text" name="Message" id="message" required/>
    </p>
    <p>
      <label for="message">Message :</label> 
      <textarea name="message" placeholder="288 caracteres maximum" rows="8" cols="35"></textarea><br />
    </p> 
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>

 <?php


?>