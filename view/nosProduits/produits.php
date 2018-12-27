<h1> Produits </h1>

<?php

if (!$tab){
	echo 'Aucun produit de disponible pour le moment';
}else{
	foreach ($tab as $produit){
		echo '<div><img src= "'.$produit->get('photo') . '" alt="' . $produit->get('idAdherent'). '"/><p>' . $produit->get('description') . '</p></div>';
	
	}
		
	}

?>