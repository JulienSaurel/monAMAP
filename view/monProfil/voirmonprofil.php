	<h1> Votre profil: </h1>
	<div>

		<ul>
			<!--gestion des photos-->
			<?php 
			if ($a->get('photo') == NULL){
				echo 'vous n\'avez pas de photo';
			} else {
				echo '<img class="imgprofil" src= "images\/'. $a->get('photo') . '" alt="' . $a->get('idAdherent'). '"/>';
			}
			?>
			<a href="?action=updatePhoto&controller=monProfil">Ajoutez ou modifiez votre photo.</a>
			
			<li>Pseudo: <?php echo $a->get('idAdherent'); ?> </li>
			<li>Nom: <?php echo $p->get('nomPersonne'); ?> </li>
			<li>Prénom: <?php echo $p->get('prenomPersonne'); ?> </li>
			<li>Adresse: <?php echo $a->get('adressepostaleAdherent'). ", " .$a->get('ville'); ?> <a href="?action=updateAdrP&controller=monProfil">Modifier votre adresse postale.</a></li>
			<li>E-mail: <?php echo $p->get('mailPersonne'); ?> </li> <!--<a href="?action=updateAdrM&controller=monProfil">Modifier votre adresse mail.</a>-->
			<li>Password : ******** <a href="?action=updatePW&controller=monProfil">Modifier votre mot de passe.</a>
			</li>
			<li>Membre depuis le <?php echo $a->get('dateinscription'); ?> </li>
			<?php if(isset($_SESSION['producteur']))
				{ ?>
					<li>Producteur depuis le <?php echo $a->get('dateproducteur'); ?> </li>
					<li>Votre description publique : 
						<?php 
						if($a->get('description') == NULL){
							echo 'vous n\'avez pas de description !';
						} else {
							echo $a->get('description'); 
						}
						?>
						<a href="?action=updateDes&controller=monProfil">Ajoutez ou modifiez votre description.</a>
					</li>
				<?php } 
			 if(isset($_SESSION['administrateur']))
				{ ?>
					<li><span class="bold"> Administrateur de l'AMAP</span></li>
			<?php } ?>
			<?php if ($a->getMontantTotal() > 0){ echo "<li>Au total vous avez donné : ".$a->getMontantTotal() ." € à l'AMAP</li>";}
			else { 
				echo "<li>Au total vous avez donné : 0 € à l'AMAP</li>";}
			?> <a href="?action=display&controller=nousSoutenir">soutenez-nous !</a>
			<li> Au total, vous avez souscrit à <?php echo count($tabTotalC);?> Contrats. </li>
			<li>Actuellement , vous souscrivez à <?php echo count($tabC);?> Contrats. </li>
			<?php if (count($tabC)!=0){ ?>
			<li>Vos contrats en cours :<a></a> <?php foreach($tabC as $contrat){
				echo "<p>Contrat ".ucfirst($contrat->get('typeContrat'))."</p>";
				echo "<p>taille : ".$contrat->get('tailleContrat')."</p>";
				echo "<p>fréquence : ".$contrat->get('frequenceContrat')."</p>";
				$idContrat =$contrat->get('idContrat');
				echo "<a href=\"?action=resilier&idC=".$idContrat."&controller=nosContrats\">Résiliser ce contrat</a>";
			} ?> </li> <?php } else { ?>
			<a href ="?action=display&controller=nosContrats" > Consultez nos contrats ! </a>
			<?php } ?>

		</ul>
	</div>
