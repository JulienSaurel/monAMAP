	<h1> Votre profil: </h1>
	<div>

		<ul>
			<!--gestion des photos-->
			<?php 
			if ($a->get('photo') == NULL){
				echo 'vous n\'avez pas de photo';
			} else {
				echo '<img class="imgprofil" src= "'. $a->get('photo') . '" alt="' . $a->get('idAdherent'). '"/>'; 
			}
			?>
			<a href="?action=updatePhoto&controller=monProfil">Ajoutez ou modifiez votre photo.</a>
			
			<li>Pseudo: <?php echo $a->get('idAdherent'); ?> </li>
			<li>Nom: <?php echo $p->get('nomPersonne'); ?> </li>
			<li>Prénom: <?php echo $p->get('prenomPersonne'); ?> </li>
			<li>Adresse: <?php echo $a->get('adressepostaleAdherent'). ", " .$a->get('ville'); ?> <a href="?action=updateAdrP&controller=monProfil">Modifier votre adresse postale.</a></li>
			<li>E-mail: <?php echo $p->get('mailPersonne'); ?> <a href="?action=updateAdrM&controller=monProfil">Modifier votre adresse mail.</a></li>
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

		</ul>
	</div>
