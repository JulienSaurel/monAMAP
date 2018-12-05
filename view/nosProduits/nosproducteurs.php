<h1>Les producteurs de l'AMAP d'O</h1>
<article>

<?php

//var_dump($tab_prod);

if (!$tab_prod){
	echo 'Pas de producteurs pour le moment';
}else{
	foreach ($tab_prod as $prod){
		//$p = ModelPersonne::select($prod->get('idPersonne'));
		echo '<div><img class="imgprofil" src= "'.$prod->get('photo') . '" alt="' . $prod->get('idAdherent'). '"/><h2>'. $prod->get('idPersonne') . '</h2><h5>' . $prod->get('ville') . '</h5><p>' . $prod->get('description') . '</p></div>';
		//echo '<div><img class="imgprofil" src= "'.$prod->get('photo') . '" alt="' . $prod->get('idAdherent'). '"/><h2>'. $p->get('nomPersonne') . '</h2><h5>' . $prod->get('ville') . '</h5><p>' . $prod->get('description') . '</p></div>';

	}
}

?>

</article>
