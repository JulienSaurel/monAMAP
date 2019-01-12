<h1>Souscrire à un contrat : </h1>

<h2> Il y a deux façons possibles de souscrire à un contrat : </h2>

<h3> Première possibilité: sourscrire en direct </h3>
<p> Il vous suffit de: </p>
<lu>
	<li><a href="?action=generePDF&controller=nosContrats" target="_blank"> Télécharger ce contrat </a> </li>
	<li> Le remplir de vos informations </li>
	<li> Le rapporter aux organisateurs lors d'une de nos distributions </li>
</lu>

<p> consultez le calendrier des distributions <a href="?action=display2nd&controller=laVieAlAMAP"> ici </a> </p>

<h3> Seconde possibilité: sourscrire en ligne </h3>

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
		      	<option <?php echo $type == "laitier"? "selected": ""; ?>> laitier </option>
		      	<option <?php echo $type == "carné"? "selected": ""; ?>> carné </option>
		      	<option <?php echo $type == "végétal"? "selected": ""; ?>> végétal </option>
		      	<option <?php echo $type == "mix"? "selected": ""; ?>> mix </option>
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
		    
		    <?php  if (isset($_SESSION['login'])) { ?>
		    	<p>
		     	 <input type="submit" value="Souscrire" />
		    	</p>
		    <?php }else{ ?>
		    	<p><span class="erreurFormulaire"> Vous devez être inscrit et connecté pour souscrire à un contrat </span></p>
		    <?php } ?>
		  
		  </fieldset> 
</form>
</div>