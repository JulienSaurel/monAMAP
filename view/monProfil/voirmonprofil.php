<?php $a = ModelAdherent::select($_SESSION['login']); // FAIRE IF ISSET !!!!!!!!!!!!!!!!?> 
	<h1> Votre profil: </h1>
	<div>
		<ul id="profil">
			<li>Pseudo: <?php echo $_SESSION['login'] ?></li>
			<li>Nom: <?php echo $a->get('nomPersonne') ?></li>
			<li>Prénom: <?php echo $a->get('prenomPersonne') ?></li>
			<li>e-mail: <?php echo $a->get('mailPersonne') ?></li>
		</ul>
	</div>
