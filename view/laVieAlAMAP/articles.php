<h1> Nos articles </h1>

<?php 
foreach ($tabArticles as $art) {
	$tabec = ModelPersonne::select($art["idAdherent"]);
	//var_dump($tabec->get('prenomPersonne'));
	echo "<h3> ".$art['titreArticle']."</h3>";
	$image = "<img src=". $art['photo']." alt=\" article \" >"; 
	echo $image;

	echo "<p> ".$art['description']."</p><br>";
	echo "<p> Ecrit par : ".$tabec->get('prenomPersonne')." ".$tabec->get('nomPersonne')."</p>";
	echo "<p> Le : ". $art['date']."</p>";
}
?>