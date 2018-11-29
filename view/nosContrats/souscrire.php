<h1>Souscrire à un contrat : </h1>
<a href="?action=generePDF&controller=nosContrats" target="_blank"> télécharger le contrat </a>

<div> <p> Vous souhaitez souscrire en ligne : </p>


    	<form method="get" action="index.php">


		  <fieldset>
		    <legend>Souscrire à un contrat :</legend>
		    <p>
		      <input type='hidden' name='action' value='souscripted'>
		    </p>
			<p>
		      <input type='hidden' name='controller' value='nosContrats'>
		    </p>
	        <p>
		      <label for="type_contrat">Type de contrat :</label> 
		      <select name = "typeContrat" size = "1">
		      	<option> laitier </option>
		      	<option> carné </option>
		      	<option> végétal </option>
		      	<option> mix </option>
		      </select>
		    </p>
		    <p>
		      <label for="taille_contrat">Taille des paniers :</label> 
		      <select name = "tailleContrat" size = "1">
		      	<option> S </option>
		      	<option> M </option>
		      	<option> L </option>
		      </select>
		    </p>
		    <p>
		      <label for="frequence_contrat">Fréquence de distribution des paniers :</label> 
		      <select name = "frequenceContrat" size = "1">
		      	<option> hebdomadaire </option>
		      	<option> mensuel </option>
		      	<option> bimensuel </option>
		      	<option> annuel </option>
		      </select>
		    </p>
		    <p>
		      <input type="submit" value="Souscrire" />
		    </p>
		  </fieldset> 
</form>
</div>