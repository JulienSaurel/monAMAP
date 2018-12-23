<h1>Les producteurs de l'AMAP d'O</h1>
<article>

<?php

//var_dump($tab_prod);

if (!$tab_prod){
	echo 'Pas de producteurs pour le moment';
}else{
	//var_dump($tab_prod);
	foreach ($tab_prod as $prod){
		echo '<div><img class="imgprofil" src= "'.$prod->get('photo') . '" alt="' . $prod->get('idAdherent'). '"/><h2>'. $prod->get('idPersonne') . '</h2><h5>' . $prod->get('ville') . '</h5><p>' . $prod->get('description') . '</p></div>';
		//var_dump($prod->get('idPersonne'));
		//$p = ModelPersonne::getPersonneById($prod->get('idPersonne'));
		//var_dump($p);
	}
}

?>

</article> 
