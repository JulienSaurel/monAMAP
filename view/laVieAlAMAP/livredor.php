<form method="post" action="./?action=created&controller=personne"> 
 <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->
  <fieldset>
    <legend>Mon site vous plaît? Laissez moi un message !</legend>
    <p>
      <label for="pseudo">Pseudo :</label> 
      <input type="text" placeholder="" name="Pseudo" id="pseudo" required/>
    </p>
    <p>
      <label for="message">Message</label> :
      <input type="text" placeholder="288 caracteres maximum" name="Message" id="message" required/>
    </p> 
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>
