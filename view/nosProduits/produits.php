<h1> Produits </h1>


<?php

if (!$tab){
	echo 'Aucun produit de disponible pour le moment';
}else{
	foreach ($tab as $produit){
		echo '<div><img src= "'.$produit->get('photo') . '" alt="' . $produit->get('idAdherent'). '"/><p>' . $produit->get('description') . '</p></div>';
	
	}
		
	}

 
//affichage seulement pour les administrateurs ou les producteurs
if (isset($_SESSION['producteur'])){  ?>
        <li>
          <a href="?action=createProd&controller=nosProduits">Ajoutez un nouveau produit.</a>
      </li>

 <?php } ?>

 <?php 

foreach ($tab as $pro) {
	//$a = ModelPersonne::select($pro->get('mailPersonne'));
	//var_dump($pro);
	//$prenom = $a->get('prenomPersonne');
	//$nom = $a->get('nomPersonne');
	//$date = $pro->get('date');
	echo '<div class="article"><h2>' . $pro->get('nomProduit') . '</h2><img src="' . $pro->get('image') . '" alt="' . $pro->get('nomProduit') . '"/><p>' . $pro->get('description') . '</p></div>'; 
}

 ?>




