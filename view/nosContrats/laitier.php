<h1>Nos contrats Laitiers</h1>
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
		      <input type="text" placeholder="Laitier" name="typeContrat" id="type_contrat" required/>
		    </p>
		    <p>
		      <label for="taille_contrat">Taille des paniers :</label> 
		      <input type="text" placeholder="Ex : S/M/L" name="tailleContrat" id="taille_contrat" required/>
		    </p>
		    <p>
		      <label for="frequence_contrat">Fréquence de distribution des paniers :</label> 
		      <input type="text" placeholder="Ex : mensuel" name="frequenceContrat" id="frequence_contrat" required/>
		    </p>
		    <p>
		      <input type="submit" value="Donner" />
		    </p>
		  </fieldset> 
</form>
</div>