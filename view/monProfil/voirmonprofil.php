	<h1> Votre profil: </h1>
	<div>

		<ul>
			<li>Pseudo: <?php echo $a->get('idAdherent'); ?> </li>
			<li>Nom: <?php echo $p->get('nomPersonne'); ?> </li>
			<li>Prénom: <?php echo $p->get('prenomPersonne'); ?> </li>
			<li>Adresse: <?php echo $a->get('adressepostaleAdherent'). ", " .$a->get('ville'); ?> <a href="?action=updateAdrP&controller=monProfil">Modifier votre adresse postale.</a></li>
			<li>E-mail: <?php echo $p->get('mailPersonne'); ?> <a href="?action=updateAdrM&controller=monProfil">Modifier votre adresse mail.</a></li>
			<li>Membre depuis le <?php echo $a->get('dateinscription'); ?> </li>
			<?php if($a->get('estProducteur')==1)
				{ ?>
					<li>Producteur depuis le <?php echo $a->get('dateproducteur'); ?> </li>
				<?php } 
			 if($a->get('estAdministrateur')==1)
				{ ?>
					<li><span class="bold"> Administrateur de l'AMAP</span></li>
			<?php } ?>
			<?php if ($a->getMontantTotal() > 0){ echo "<li>Au total vous avez donné : ".$a->getMontantTotal() ." € à l'AMAP</li>";}
			else { 
				echo "<li>Au total vous avez donné : 0 € à l'AMAP</li>";}
			?>

		</ul>
	</div>
