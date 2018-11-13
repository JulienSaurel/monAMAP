<p> Vous souhaitez faire un don à l'AMAP? c'est ici: </p>


    	<form method="get" action="index.php">


		  <fieldset>
		    <legend>Faire un don :</legend>
		    <p>
		      <input type='hidden' name='action' value='donnated'>
		    </p>
			<p>
		      <input type='hidden' name='controller' value='NousSoutenir'>
		    </p>
			<p>
		      <label for="prenom_donnateur">Prénom : </label> :
		      <input type="text" placeholder="Ex : Henri" name="Prenom_donnateur" id="prenom_donnateur" required/>
		    </p>
		    <p>
		      <label for="nom_donnateur">Nom: </label> :
		      <input type="text" placeholder="Ex : Dupont" name="Nom_donnateur" id="nom_donnateur" required/>
		    </p>
			<p>
		      <label for="mail_donnateur">Adresse mail : </label> :
		      <input type="email" placeholder="Ex : henridupont@gmail.com" name="Mail_donnateur" id="mail_donnateur" required/>
		    </p>
		    <p>
		      <label for="montant_don">Montant à donner (en euro): </label> :
		      <input type="number" placeholder="Ex : 5" name="Montant_don" id="montant_don" required/>
		    </p>
		    <p>
		      <input type="submit" value="Donner" />
		    </p>
		  </fieldset> 
</form>

