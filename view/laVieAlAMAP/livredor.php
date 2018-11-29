<form method="post" action="?action=created&controller=LaVieAlAMAP"> 
 <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->
  <fieldset>
    <legend>L'AMAP vous plaît? Laissez nous un message !</legend>
    <p>
      <label for="pseudo">Pseudo :</label> 
       <input type="text" name="pseudo" id="pseudo" required/>
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
 for($i=0; $i<$nombrepages; $i++)
  {
    echo "<p> <a href=\"?action=liremessage&controller=LaVieAlAMAP&page={$i}\"> $i </a> </p>";
  }

  echo '<p>' . $tab[0]->get('pseudo') . ' a écrit :<br />' . $tab[0]->get('message') . '</p>';
    ?>