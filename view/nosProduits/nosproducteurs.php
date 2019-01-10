<h1>Les producteurs de l'AMAP d'O</h1>
<article>

<?php

//var_dump($tab_prod);

if (!$tab_prod){
	echo 'Pas de producteurs pour le moment';
}else{
	//var_dump($tab_prod);
	foreach ($tab_prod as $prod){
		$a = ModelPersonne::select($prod->get('mailPersonne'));
		$prenom = $a->get('prenomPersonne');
		$nom = $a->get('nomPersonne');
		echo '<div><img class="imgprofil" src= "'.$prod->get('photo') . '" alt="' . $prod->get('idAdherent'). '"/><h2>'. $prenom . ' ' . $nom . ' - ' . $prod->get('ville') . '</h2><p>' . $prod->get('description') . '</p></div>';
		//var_dump($prod->get('mailPersonne'));
		//$p = ModelPersonne::getPersonneById($prod->get('mailPersonne'));
		//var_dump($prod->get('photo'));
	}
}

?>

</article> 
