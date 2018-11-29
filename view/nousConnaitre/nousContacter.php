
		
		
	
		<div> <p> Nous contacter : </p>


    	<form method="get" action="index.php">


		  <fieldset>
		    <legend>Formulaire de contact :</legend>
		    <p>
		      <input type='hidden' name='action' value='donnated'>
		    </p>
			<p>
		      <input type='hidden' name='controller' value='nousConnaitre'>
		    </p>
			<p>
		      <label for="prenom_donnateur">Prénom :</label> 
		      <input type="text" placeholder="Ex : Henri" name="Prenom_donnateur" id="prenom_donnateur" required/>
		    </p>
		    <p>
		      <label for="nom_donnateur">Nom :</label> 
		      <input type="text" placeholder="Ex : Dupont" name="Nom_donnateur" id="nom_donnateur" required/>
		    </p>
			<p>
		      <label for="mail_donnateur">Adresse mail :</label> 
		      <input type="email" placeholder="Ex : henridupont@gmail.com" name="Mail_donnateur" id="mail_donnateur" required/>
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
</div>

