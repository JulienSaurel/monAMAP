	<h1> Votre profil: </h1>
	<div>

		<ul>
			<!--gestion des photos-->
			<?php

            $photo = $a->get('photo');
            $idAdherent = $a->get('idAdherent');
            if ($photo == NULL){
				echo 'vous n\'avez pas de photo';
			} else {
				echo "<img class=\"imgprofil\" src=\"$photo\" alt=\"$idAdherent\"/>";
			}
			?>
			<li>Pseudo: <?php echo htmlspecialchars($a->get('idAdherent')); ?> </li>
			<li>Nom: <?php echo htmlspecialchars($p->get('nomPersonne')); ?> </li>
			<li>Prénom: <?php echo htmlspecialchars($p->get('prenomPersonne')); ?> </li>
			<li>E-mail: <?php echo htmlspecialchars($p->get('mailPersonne')); ?> </li> <!--<a href="?action=updateAdrM&controller=monProfil">Modifier votre adresse mail.</a>-->
			</li>
			<li>Membre depuis le <?php echo htmlspecialchars($a->get('dateinscription')); ?> </li>
            <li>Adhésion valide jusqu'au <?php echo htmlspecialchars($a->get('limiteAdhesion')) ?></li>
			<?php if(isset($_SESSION['producteur']))
				{ ?>
					<li>Producteur depuis le <?php echo htmlspecialchars($a->get('dateproducteur')); ?> </li>
					<li>Votre description publique : 
						<?php 
						if($a->get('description') == NULL){
							echo 'vous n\'avez pas de description !';
						} else {
							echo htmlspecialchars($a->get('description')); 
						}
						?>
					</li>
				<?php } 
			 if(isset($_SESSION['administrateur']))
				{ ?>
					<li><span class="bold"> Administrateur de l'AMAP</span></li>
			<?php } ?>
			<?php if ($a->getMontantTotal() > 0){ echo "<li>Au total vous avez donné : ".$a->getMontantTotal() ." € à l'AMAP</li>";}
			else { 
				echo "<li>Au total vous avez donné : 0 € à l'AMAP</li>";}
			?>
			<li> Au total, vous avez souscrit à <?php echo count($tabTotalC);?> Contrats. </li>
			<li>Actuellement , vous souscrivez à <?php echo count($tabC);?> Contrats. </li>
			<?php if (count($tabC)!=0){ ?>
			<li>Vos contrats en cours :<a></a> <?php foreach($tabC as $contrat){
				echo "<p>Contrat ".ucfirst(htmlspecialchars($contrat->get('typeContrat')))."</p>";
				echo "<p>taille : ". htmlspecialchars($contrat->get('tailleContrat'))."</p>";
				echo "<p>fréquence : ".htmlspecialchars($contrat->get('frequenceContrat'))."</p>";
				$idContrat =$contrat->get('idContrat');
				echo "<a href=\"?action=resilier&idC=".urlencode($idContrat)."&controller=nosContrats\">Résiliser ce contrat</a>";
			} ?> </li> <?php } else { ?>
			<?php } ?>

		</ul>
        <p><a href="?action=donnate&controller=nousSoutenir">Soutenez-nous !</a></p>
        <p><a href="?action=gotoupdate&controller=monProfil">Modifier votre profil</a></p>
        <p><a href="?action=updatePW&controller=monProfil">Modifier votre mot de passe</a></p>
        <p><a href ="?action=detail&controller=nosContrats" >Consultez nos contrats !</a></p>
        <p><a href="?action=payment&controller=adherent&from=prolonger&id=<?php echo urlencode($idAdherent);?>">Prolonger votre adhésion</a></p>
    </div>
